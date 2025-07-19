<?php

declare(strict_types=1);

namespace OnurSimsek\Craftgate\ValueObjects;

class Card extends ValueObject
{
    /**
     * @param string $cardHolderName Kart sahibinin adı/soyadı
     * @param string $cardNumber Kart numarası
     * @param string $expireYear Kartın son kullanım tarihinin yılı
     * @param string $expireMonth Kartın son kullanım tarihinin ayı
     * @param string $cvc Kart güvenlik kodu
     * @param bool $storeCardAfterSuccessPayment Ödeme sonrası kart kaydedilsin mi?
     * @param string|null $cardAlias Başarılı ödemeden sonra kart kaydedilecekse karta verilecek isim
     * @param string|null $cardUserKey Daha önceden kart sakladıysanız, Craftgate tarafından üretilip size dönülen kart kullanıcı anahtarını bu parametrede göndermelisiniz. İlk defa kart saklanıyor ise bu alan gönderilmemelidir.
     * @param string|null $cardToken Kart anahtarı. Craftgate tarafından üretilir ve kart saklama isteği sonrası üye işyerine dönülür. Kart bazlı özeldir. CardUserKey ile birlikte kullanılır.
     * @param Loyalty|null $loyalty Ödeme esnasında kullanılmak istenen ödül bilgileri. Detaylı bilgilere Ödül ve Puan Kullanımı adresinden ulaşabilirsiniz.
     */
    public function __construct(
        public readonly string $cardHolderName,
        public readonly string $cardNumber,
        public readonly string $expireYear,
        public readonly string $expireMonth,
        public readonly string $cvc,
        public readonly bool $storeCardAfterSuccessPayment = false,
        public readonly ?string $cardAlias = null,
        public readonly ?string $cardUserKey = null,
        public readonly ?string $cardToken = null,
        public readonly ?Loyalty $loyalty = null,
    ) {
    }

    public static function fromArray(array $params): static
    {
        return new self(
            cardHolderName: $params['cardHolderName'],
            cardNumber: $params['cardNumber'],
            expireYear: $params['expireYear'],
            expireMonth: $params['expireMonth'],
            cvc: $params['cvc'],
            storeCardAfterSuccessPayment: $params['storeCardAfterSuccessPayment'] ?? false,
            cardAlias: $params['cardAlias'] ?? null,
            cardUserKey: $params['cardUserKey'] ?? null,
            cardToken: $params['cardToken'] ?? null,
            loyalty: $params['loyalty'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'cardHolderName' => $this->cardHolderName,
            'cardNumber' => $this->cardNumber,
            'expireYear' => $this->expireYear,
            'expireMonth' => $this->expireMonth,
            'cvc' => $this->cvc,
            'storeCardAfterSuccessPayment' => $this->storeCardAfterSuccessPayment,
            'cardAlias' => $this->cardAlias,
            'cardUserKey' => $this->cardUserKey,
            'cardToken' => $this->cardToken,
            'loyalty' => $this->loyalty,
        ];
    }
}
