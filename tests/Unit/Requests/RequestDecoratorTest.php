<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Uri;
use OnurSimsek\Craftgate\Contracts\Options;
use OnurSimsek\Craftgate\Contracts\Proxy;
use OnurSimsek\Craftgate\Requests\BaseRequest;
use OnurSimsek\Craftgate\Requests\Header;
use OnurSimsek\Craftgate\Requests\RequestDecorator;
use OnurSimsek\Craftgate\Tests\TestCase;
use OnurSimsek\Craftgate\Tests\Traits\WithRequest;
use PHPUnit\Framework\Attributes\Test;
use Psr\Http\Message\RequestInterface;

class RequestDecoratorTest extends TestCase
{
    use WithRequest;

    private function baseRequest(): BaseRequest
    {
        $mock = $this->fakeServer();
        $this->addResponse(200, 'Hello, World');

        return new BaseRequest($this->options(), new Client(['handler' => HandlerStack::create($mock)]));
    }

    public static function proxy(): Proxy
    {
        return new class () implements Proxy {
            public function foo(): string
            {
                return 'foo';
            }
        };
    }

    private function decoratorInstance(): RequestDecorator
    {
        return new class ($this->baseRequest()) extends RequestDecorator {
            protected string $prefix = 'payments';
            protected string $version = 'v1';

            protected function proxy(): Proxy
            {
                return RequestDecoratorTest::proxy();
            }
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
    public function it_should_be_set_path()
    {
        $decorator = $this->decoratorInstance();

        $path = ['deposits', 'apm-init'];

        $this->assertEquals(
            expected: 'payments/v1/' . implode('/', $path),
            actual: $decorator->withPath(...$path)->psrRequest()->getUri()->getPath()
        );
    }

    #[Test]
    public function it_should_be_set_query()
    {
        $decorator = $this->decoratorInstance();

        $query = ['foo' => 'bar', 'zoo' => 'bar'];

        $this->assertEquals(http_build_query($query), $decorator->withQuery($query)->psrRequest()->getUri()->getQuery());
    }

    #[Test]
    public function it_should_be_set_method()
    {
        $decorator = $this->decoratorInstance();

        $this->assertEquals('GET', $decorator->psrRequest()->getMethod());
        $this->assertEquals('POST', $decorator->withMethod('POST')->psrRequest()->getMethod());
    }

    #[Test]
    public function it_should_be_set_body()
    {
        $decorator = $this->decoratorInstance();

        $params = ['foo' => 'bar'];

        $decorator->withBody($params);

        $this->assertEquals(json_encode($params), $decorator->psrRequest()->getBody());
    }

    #[Test]
    public function it_should_be_send_a_request()
    {
        $decorator = $this->decoratorInstance();

        $response = $decorator->send();

        $this->assertTrue($decorator->psrRequest()->hasHeader(Header::RandomKey->value));
        $this->assertTrue($decorator->psrRequest()->hasHeader(Header::Signature->value));

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('Hello, World', $response->getBody()->getContents());
    }

    #[Test]
    public function it_should_be_run_proxy_class_method()
    {
        $decorator = $this->decoratorInstance();

        $this->assertEquals('foo', $decorator->foo());

        $this->expectException(\BadMethodCallException::class);
        $decorator->bar();
    }
}
