<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\Endpoints;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Uri;
use OnurSimsek\Craftgate\Contracts\Options;
use OnurSimsek\Craftgate\Endpoints\BaseRequest;
use OnurSimsek\Craftgate\Endpoints\Header;
use OnurSimsek\Craftgate\Endpoints\RequestDecorator;
use OnurSimsek\Craftgate\Tests\TestCase;
use OnurSimsek\Craftgate\Tests\Traits\WithRequest;
use PHPUnit\Framework\Attributes\Test;
use Psr\Http\Message\RequestInterface;

class RequestDecoratorTest extends TestCase
{
    use WithRequest;

    private function decoratorInstance(): RequestDecorator
    {
        $mock = $this->fakeServer();
        $this->addResponse(200, 'Hello, World');

        $request = new BaseRequest($this->options(), new Client(['handler' => HandlerStack::create($mock)]));

        return new class ($request) extends RequestDecorator {
        };
    }

    #[Test]
    public function it_should_be_initialized()
    {
        $decorator = $this->decoratorInstance();

        $this->assertInstanceOf(Options::class, $decorator->options());
        $this->assertInstanceOf(RequestInterface::class, $decorator->psrRequest());
    }

    #[Test]
    public function it_should_be_set_uri()
    {
        $decorator = $this->decoratorInstance();

        $expected = 'https://example.com/installment/v1/installment';

        $this->assertEquals($expected, $decorator->withUri(new Uri($expected))->psrRequest()->getUri());
    }

    #[Test]
    public function it_should_be_set_method()
    {
        $decorator = $this->decoratorInstance();

        $this->assertEquals('GET', $decorator->psrRequest()->getMethod());
        $this->assertEquals('POST', $decorator->withMethod('POST')->psrRequest()->getMethod());
    }

    #[Test]
    public function it_should_be_send_a_request()
    {
        $mock = $this->fakeServer();
        $this->addResponse(200, 'Hello, World');

        $request = new BaseRequest($this->options(), new Client(['handler' => HandlerStack::create($mock)]));
        $decorator = new class ($request) extends RequestDecorator {
        };

        $response = $decorator->send();

        $this->assertTrue($decorator->psrRequest()->hasHeader(Header::RandomKey->value));
        $this->assertTrue($decorator->psrRequest()->hasHeader(Header::Signature->value));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Hello, World', $response->getBody()->getContents());
    }
}
