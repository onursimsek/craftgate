<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\Endpoints;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use OnurSimsek\Craftgate\Endpoints\BaseRequest;
use OnurSimsek\Craftgate\Endpoints\Installment;
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
    public function it_should_be_send_a_search_installment_request()
    {
        $installments = $this->installmentInstance();

        $response = $installments->searchInstallments();

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('installment/v1/installments', $installments->psrRequest()->getUri()->getPath());

        $installments = $this->installmentInstance();

        $response = $installments->searchInstallments([
            'binNumber' => '123456',
            'price' => 100,
        ]);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('installment/v1/installments', $installments->psrRequest()->getUri()->getPath());
        $this->assertEquals('binNumber=123456&price=100', $installments->psrRequest()->getUri()->getQuery());
    }

    #[Test]
    public function it_should_be_send_a_retrieve_bin_number_request()
    {
        $installments = $this->installmentInstance();

        $response = $installments->retrieveBinNumber('123456');

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('installment/v1/bins/123456', $installments->psrRequest()->getUri()->getPath());
    }
}
