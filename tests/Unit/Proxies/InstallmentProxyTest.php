<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\Proxies;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use OnurSimsek\Craftgate\Proxies\InstallmentProxy;
use OnurSimsek\Craftgate\Requests\BaseRequest;
use OnurSimsek\Craftgate\Requests\Installment;
use OnurSimsek\Craftgate\Tests\Traits\WithRequest;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class InstallmentProxyTest extends TestCase
{
    use WithRequest;

    private function installmentInstance(): InstallmentProxy
    {
        $mock = $this->fakeServer();
        $this->addResponse(200, 'Hello, World');

        $request = new BaseRequest($this->options(), new Client(['handler' => HandlerStack::create($mock)]));

        return new InstallmentProxy(new Installment($request));
    }

    #[Test]
    public function it_should_be_make_a_search_request()
    {
        // Search
        $installments = $this->installmentInstance();
        $response = $installments->searchInstallments(['price' => 100]);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('installment/v1/installments', $installments->installment->psrRequest()->getUri()->getPath());

        // Search with parameters
        $installments = $this->installmentInstance();
        $response = $installments->searchInstallments([
            'binNumber' => '123456',
            'price' => 100,
        ]);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('installment/v1/installments', $installments->installment->psrRequest()->getUri()->getPath());
        $this->assertEquals('price=100&binNumber=123456', $installments->installment->psrRequest()->getUri()->getQuery());
    }

    #[Test]
    public function it_should_be_make_a_bin_request()
    {
        $installments = $this->installmentInstance();
        $response = $installments->retrieveBinNumber('123456');

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('installment/v1/bins/123456', $installments->installment->psrRequest()->getUri()->getPath());
    }
}
