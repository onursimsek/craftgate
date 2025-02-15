<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\Endpoints;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Uri;
use OnurSimsek\Craftgate\Contracts\Options;
use OnurSimsek\Craftgate\Endpoints\BaseRequest;
use OnurSimsek\Craftgate\Endpoints\Header;
use OnurSimsek\Craftgate\Tests\TestCase;
use OnurSimsek\Craftgate\Tests\Traits\WithRequest;
use PHPUnit\Framework\Attributes\Test;
use Psr\Http\Message\RequestInterface;

class BaseRequestTest extends TestCase
{
    use WithRequest;

    #[Test]
    public function it_should_be_initialized(): void
    {
        $request = new BaseRequest($this->options(), $this->client());

        $this->assertInstanceOf(Options::class, $request->options());
        $this->assertInstanceOf(RequestInterface::class, $request->psrRequest());

        $this->assertEquals(['onursimsek/craftgate:1.0.0'], $request->psrRequest()->getHeader(Header::ClientVersion->value));
        $this->assertEquals(['v1'], $request->psrRequest()->getHeader(Header::AuthVersion->value));
        $this->assertEquals([$this->options()->getApiKey()], $request->psrRequest()->getHeader(Header::ApiKey->value));

        $this->assertEquals($this->options()->getBaseUrl(), $request->psrRequest()->getUri()->__toString());
    }

    #[Test]
    public function it_should_be_set_uri()
    {
        $request = new BaseRequest($this->options(), $this->client());

        $expected = 'https://example.com/installment/v1/installment';

        $this->assertEquals($expected, $request->withUri(new Uri($expected))->psrRequest()->getUri());
    }

    #[Test]
    public function it_should_be_set_method()
    {
        $request = new BaseRequest($this->options(), $this->client());

        $this->assertEquals('GET', $request->psrRequest()->getMethod());
        $this->assertEquals('POST', $request->withMethod('POST')->psrRequest()->getMethod());
    }

    #[Test]
    public function it_should_be_set_a_header()
    {
        $request = new BaseRequest($this->options(), $this->client());

        $this->assertEquals(['bar'], $request->withHeader('x-foo', 'bar')->psrRequest()->getHeader('x-foo'));
    }

    #[Test]
    public function it_should_be_send_a_request()
    {
        $mock = $this->fakeServer();
        $mock->append(new Response(200, ['x-foo' => 'bar'], 'Hello, World'));

        $request = new BaseRequest($this->options(), new Client(['handler' => HandlerStack::create($mock)]));
        $response = $request->send();

        $this->assertTrue($request->psrRequest()->hasHeader(Header::RandomKey->value));
        $this->assertTrue($request->psrRequest()->hasHeader(Header::Signature->value));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(['bar'], $response->getHeader('x-foo'));
        $this->assertEquals('Hello, World', $response->getBody()->getContents());
    }
}
