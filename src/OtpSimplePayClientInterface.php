<?php

declare(strict_types = 1);

namespace Cheppers\OtpspClient;

use Cheppers\OtpspClient\DataType\BackResponse;
use Cheppers\OtpspClient\DataType\PaymentRequest;
use Cheppers\OtpspClient\DataType\PaymentResponse;
use Cheppers\OtpspClient\DataType\RefundRequest;
use Cheppers\OtpspClient\DataType\InstantPaymentNotification;
use Cheppers\OtpspClient\DataType\RefundResponse;
use Cheppers\OtpspClient\DataType\RequestBase;
use DateTimeInterface;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface OtpSimplePayClientInterface
{

    /**
     * In PHP 7.1 \DateTimeInterface::RFC3339 is not available.
     *
     * @see \DateTimeInterface::RFC3339
     */
    const DATETIME_FORMAT = 'Y-m-d\TH:i:sP';

    public function getBaseUri(): string;

    /**
     * @return $this
     */
    public function setBaseUri(string $baseUri);

    /**
     * @return mixed
     */
    public function setBaseUriByMode(string $mode);

    public function getClient(): ClientInterface;

    /**
     * @return $this
     */
    public function setClient(ClientInterface $client);

    public function getChecksum(): ChecksumInterface;

    /**
     * @return $this
     */
    public function setChecksum(ChecksumInterface $checksum);

    public function getNow(): DateTimeInterface;

    /**
     * @return $this
     */
    public function setNow(DateTimeInterface $now);

    public function getSecretKey(): string;

    /**
     * @return $this
     */
    public function setSecretKey(string $secretKey);

    /**
     * @return string[]
     */
    public function getSupportedLanguages(): array;

    public function startPayment(PaymentRequest $paymentRequest): PaymentResponse;

    public function startRefund(RefundRequest $refundRequest): RefundResponse;

    public function parseBackResponse(string $url): BackResponse;

    public function parseInstantPaymentNotificationRequest(RequestInterface $request): ?InstantPaymentNotification;

    public function parseInstantPaymentNotificationMessage(
        string $signature,
        string $bodyContent
    ): ?InstantPaymentNotification;

    public function getInstantPaymentNotificationSuccessResponse(InstantPaymentNotification $ipn): ResponseInterface;

    public function getInstantPaymentNotificationSuccessParts(InstantPaymentNotification $ipn): array;

    public function sendRequest(RequestBase $requestType, string $path): ResponseInterface;
}
