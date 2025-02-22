<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use OnurSimsek\Craftgate\Proxies\InstallmentProxy;
use OnurSimsek\Craftgate\Requests\BaseRequest;
use OnurSimsek\Craftgate\Requests\Installment;
use OnurSimsek\Craftgate\Tests\TestCase;
use OnurSimsek\Craftgate\Tests\Traits\WithRequest;
use PHPUnit\Framework\Attributes\Test;
use Psr\Http\Message\ResponseInterface;

class InstallmentTest extends TestCase
{
    use WithRequest;

    private function installmentInstance(): Installment
    {
        $mock = $this->fakeServer();
        $this->addResponse(200, 'Hello, World');

        $request = new BaseRequest($this->options(), new Client(['handler' => HandlerStack::create($mock)]));

        return new Installment($request);
    }

    #[Test]
    public function it_should_be_make_a_search_request()
    {
        // Search
        $installments = $this->installmentInstance();
        $response = $installments->search(100);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('installment/v1/installments', $installments->psrRequest()->getUri()->getPath());
        $this->assertEquals('price=100', $installments->psrRequest()->getUri()->getQuery());

        // Search with parameters
        $installments = $this->installmentInstance();
        $response = $installments->search(100, [
            'binNumber' => '123456',
        ]);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('installment/v1/installments', $installments->psrRequest()->getUri()->getPath());
        $this->assertEquals('price=100&binNumber=123456', $installments->psrRequest()->getUri()->getQuery());
    }

    #[Test]
    public function it_should_be_make_a_bin_request()
    {
        $installments = $this->installmentInstance();

        $response = $installments->bin('123456');

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('installment/v1/bins/123456', $installments->psrRequest()->getUri()->getPath());
    }

    #[Test]
    public function it_should_have_proxy()
    {
        $proxy = $this->installmentInstance()->proxy();

        $this->assertInstanceOf(InstallmentProxy::class, $proxy);
    }
}
