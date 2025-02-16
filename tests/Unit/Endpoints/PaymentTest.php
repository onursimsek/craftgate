<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\Tests\Unit\Endpoints;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use OnurSimsek\Craftgate\Endpoints\BaseRequest;
use OnurSimsek\Craftgate\Endpoints\Payment;
use OnurSimsek\Craftgate\Tests\TestCase;
use OnurSimsek\Craftgate\Tests\Traits\WithRequest;
use OnurSimsek\Craftgate\Util;
use PHPUnit\Framework\Attributes\Test;
use Psr\Http\Message\ResponseInterface;

class PaymentTest extends TestCase
{
    use WithRequest;

    private function instance(): Payment
    {
        $mock = $this->fakeServer();
        $this->addResponse(200, 'Hello, World');

        $request = new BaseRequest($this->options(), new Client(['handler' => HandlerStack::create($mock)]));

        return new Payment($request);
    }

    #[Test]
    public function it_should_be_send_a_create_payment_request()
    {
        $request = $this->instance();

        $params = [
            'price' => 100,
            'paidPrice' => 100,
            'walletPrice' => 0,
            'installment' => 1,
            'currency' => 'TRY',
            'paymentGroup' => 'LISTING_OR_SUBSCRIPTION',
            'conversationId' => Util::guid(),
            'card' => [
                'cardHolderName' => 'John Doe',
                'cardNumber' => '5258640000000001',
                'expireYear' => '2085',
                'expireMonth' => '01',
                'cvc' => '015'
            ],
            'items' => [
                [
                    'externalId' => Util::guid(),
                    'name' => 'Item 1',
                    'price' => 30
                ],
                [
                    'externalId' => Util::guid(),
                    'name' => 'Item 2',
                    'price' => 50
                ],
                [
                    'externalId' => Util::guid(),
                    'name' => 'Item 3',
                    'price' => 20
                ]
            ]
        ];

        $response = $request->createPayment($params);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('POST', $request->psrRequest()->getMethod());
        $this->assertEquals('payment/v1/card-payments', $request->psrRequest()->getUri()->getPath());
        $this->assertEquals(json_encode($params), $request->psrRequest()->getBody());
    }

    #[Test]
    public function it_should_be_send_a_retrieve_payment_request()
    {
        $request = $this->instance();

        $paymentId = 1010;

        $response = $request->retrievePayment($paymentId);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('GET', $request->psrRequest()->getMethod());
        $this->assertEquals('payment/v1/card-payments/' . $paymentId, $request->psrRequest()->getUri()->getPath());
    }

    #[Test]
    public function it_should_be_send_a_post_auth_payment_request()
    {
        $request = $this->instance();

        $paymentId = 1010;
        $params = ['paidPrice' => 100];

        $response = $request->postAuthPayment($paymentId, $params);

        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals('POST', $request->psrRequest()->getMethod());
        $this->assertEquals(
            expected: 'payment/v1/card-payments/' . $paymentId . '/post-auth',
            actual: $request->psrRequest()->getUri()->getPath()
        );

        $this->assertEquals(json_encode($params), $request->psrRequest()->getBody());
    }
}
