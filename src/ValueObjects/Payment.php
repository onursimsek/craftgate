<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

use OnurSimsek\Craftgate\Enums\Currency;
use OnurSimsek\Craftgate\Enums\PaymentGroup;
use OnurSimsek\Craftgate\Enums\PaymentPhase;
use OnurSimsek\Craftgate\ValueObjects\Components\AdditionalParams;
use OnurSimsek\Craftgate\ValueObjects\Components\Card;
use OnurSimsek\Craftgate\ValueObjects\Components\FraudCheck;
use OnurSimsek\Craftgate\ValueObjects\Components\PaymentItem;

class Payment extends ValueObject
{
    /**
     * @param float $price Toplam ödeme tutarı. Sepetteki ürün/hizmet tutarları toplamının bu tutara eşit olması gerekmektedir
     * @param float $paidPrice Komisyon ve indirim gibi farklar dahil edilerek hesaplanan, karttan çekilecek nihai tutar. Tamamı ya da bir kısmı cüzdandan tahsil edilen ödemelerde cüzdandan tahsil edilecek tutar da bu tutara dahildir. İşlemde vade farkı var ise vade farkı eklenmiş tutar bu parametreye girilmelidir.
     * @param Currency $currency Para Birimleri Ödemenin tahsil edileceği para birimi
     * @param int $installment Ödemenin tahsil edileceği taksit sayısı. Tek çekim için 1 olarak gönderilebilir.
     * @param float $walletPrice buyerMemberId parametresinde belirtilen alıcının cüzdanından tahsil edilecek tutar. Kısmen ya da tamamen cüzdandan tahsil edilecek ödemelerde gönderilmesi zorunludur. Tamamı karttan tahsil edilecek ödemelerde ya da bir buyerMemberId bulunmadığı durumda 0 olarak gönderilebilir.
     * @param array $items Ödemeye ilişkin kırılım bilgileri. En az bir kırılım gönderilmesi ve gönderilen kırılımların tutarlarının toplamının price alanına eşit olması zorunludur
     * @param PaymentGroup|null $paymentGroup Ödeme Grupları
     * @param string|null $conversationId İstekle beraber gönderilip, cevapla birlikte alınabilecek, "bumerang" değer. Farklı istekleri birbirleriyle ilişkilendirmek için kullanılabilir
     * @param Card|null $card Tahsilatın gerçekleştirileceği kart bilgileri. Ödeme yöntemine göre ileteceğiniz zorunlu alanlar değişkenlik gösterebilir. Tamamı cüzdandan tahsil edilecek ödemelerde (yani paidPrice'in walletPrice'a eşit olduğu ödemeler) gönderilmemelidir
     * @param int|null $buyerMemberId Ödemenin ilişkilendirildiği alıcı ID'si. Üye işyerinin kendi sistemlerindeki ID değerini değil, Craftgate sistemlerindeki ID değerini ifade eder
     * @param string|null $externalId Genellikle üye işyeri tarafındaki, ödemeye ilişkin sipariş numarası veya sepet numarası olarak kullanılır. Daha sonradan sorgulama servislerinde bu id ile sorgulama yapabilirsiniz.
     * @param PaymentPhase|null $paymentPhase Ödeme Fazları
     * @param string|null $paymentChannel Genellikle üye işyeri tarafındaki, ödemenin alındığı kanal veya ödemeye özel bir bilgi tutmak için kullanılır. Daha sonradan sorgulama servislerini kullanarak bu değer ile sorgulama yapabilirsiniz.
     * @param string|null $bankOrderId Ödeme alınırken bankaya iletilecek orderId parametresi. Opsiyonel olduğu için gönderilmemesi ve orderId değerinin Craftgate tarafından üretilmesi önerilir.
     * @param string|null $clientIp Ödeme yapan alıcının IPv4 adresi.
     * @param string|null $posAlias Ödemeyi geçirmek istediğiniz pos'un alias değeri. Ödemenin geçeceği pos'a kendiniz karar verdiyseniz bu parametre ile ilgili posdan ödeme alabilirsiniz.
     * @param bool $retry Bazı ödeme hatalarından(invalid transaction, do not honour vs) sonra otomatik olarak ikinci bir pos ile denenip denenmeyeceğine karar verebilirsiniz.
     * @param FraudCheck|null $fraudParams Fraud kontrolü için gönderilebilecek ek parametreler
     * @param AdditionalParams|null $additionalParams
     */
    public function __construct(
        public readonly float $price,
        public readonly float $paidPrice,
        public readonly array $items,
        public readonly Currency $currency = Currency::TL,
        public readonly int $installment = 1,
        public readonly float $walletPrice = 0,
        public readonly ?PaymentGroup $paymentGroup = null,
        public readonly ?string $conversationId = null,
        public readonly ?Card $card = null,
        public readonly ?int $buyerMemberId = null,
        public readonly ?string $externalId = null,
        public readonly ?PaymentPhase $paymentPhase = null,
        public readonly ?string $paymentChannel = null,
        public readonly ?string $bankOrderId = null,
        public readonly ?string $clientIp = null,
        public readonly ?string $posAlias = null,
        public readonly bool $retry = true,
        public readonly ?FraudCheck $fraudParams = null,
        public readonly ?AdditionalParams $additionalParams = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new self(
            price: $params['price'],
            paidPrice: $params['paidPrice'],
            items: self::hydrate($params['items'], PaymentItem::class, true),
            currency: $params['currency'] ?? Currency::TL,
            installment: $params['installment'] ?? 1,
            walletPrice: $params['walletPrice'] ?? 0.0,
            paymentGroup: self::hydrate($params['paymentGroup'] ?? null, PaymentGroup::class),
            conversationId: $params['conversationId'] ?? null,
            card: self::hydrate($params['card'] ?? null, Card::class),
            buyerMemberId: $params['buyerMemberId'] ?? null,
            externalId: $params['externalId'] ?? null,
            paymentPhase: $params['paymentPhase'] ?? null,
            paymentChannel: $params['paymentChannel'] ?? null,
            bankOrderId: $params['bankOrderId'] ?? null,
            clientIp: $params['clientIp'] ?? null,
            posAlias: $params['posAlias'] ?? null,
            retry: $params['retry'] ?? true,
            fraudParams: self::hydrate($params['fraudParams'] ?? null, FraudCheck::class),
            additionalParams: self::hydrate($params['additionalParams'] ?? null, AdditionalParams::class),
        );
    }

    public function toArray(): array
    {
        return [
            'price' => $this->price,
            'paidPrice' => $this->paidPrice,
            'items' => self::dehydrateList($this->items),
            'currency' => $this->currency->value,
            'installment' => $this->installment,
            'walletPrice' => $this->walletPrice,
            'paymentGroup' => $this->paymentGroup?->value,
            'conversationId' => $this->conversationId,
            'card' => $this->card?->toArray(),
            'buyerMemberId' => $this->buyerMemberId,
            'externalId' => $this->externalId,
            'paymentPhase' => $this->paymentPhase?->value,
            'paymentChannel' => $this->paymentChannel,
            'bankOrderId' => $this->bankOrderId,
            'clientIp' => $this->clientIp,
            'posAlias' => $this->posAlias,
            'retry' => $this->retry,
            'fraudParams' => $this->fraudParams?->toArray(),
            'additionalParams' => $this->additionalParams?->toArray(),
        ];
    }
}
