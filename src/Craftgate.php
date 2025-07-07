<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate;

use OnurSimsek\Craftgate\Contracts\Options as OptionsContract;
use OnurSimsek\Craftgate\Contracts\RequestInterface;
use OnurSimsek\Craftgate\Requests\BaseRequest;
use OnurSimsek\Craftgate\Requests\Installment;
use OnurSimsek\Craftgate\Requests\Payment;
use Psr\Http\Client\ClientInterface;

final class Craftgate
{
    private RequestInterface $baseRequest;

    private Installment $installment;

    private Payment $payment;

    public function __construct(private readonly OptionsContract $options, private readonly ClientInterface $client)
    {
        $this->baseRequest = new BaseRequest($this->options, $this->client);
    }

    public function installment(): Installment
    {
        return $this->installment ??= new Installment($this->baseRequest);
    }

    public function payment(): Payment
    {
        return $this->payment ??= new Payment($this->baseRequest);
    }
}
