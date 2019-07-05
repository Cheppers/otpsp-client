<?php

namespace Cheppers\OtpspClient;

use Cheppers\OtpspClient\DataType\Backref;
use Cheppers\OtpspClient\DataType\InstantDeliveryNotification;
use Cheppers\OtpspClient\DataType\InstantOrderStatus;
use Cheppers\OtpspClient\DataType\InstantRefundNotification;
use Cheppers\OtpspClient\DataType\InstantPaymentNotification;

interface OtpSimplePayClientInterface
{
    const RETURN_CODE_SUCCESS = '000';

    const RETURN_CODE_SUCCESS_1 = '001';

    const STATUS_CODE_SUCCESS = 1;

    const STATUS_CODE_NOT_FOUND = 5011;

    const CONTROL_KEY = 'ctrl';

    public function instantDeliveryNotificationPost(
        string $orderRef,
        string $orderAmount,
        string $orderCurrency
    ): ?InstantDeliveryNotification;

    public function instantRefundNotificationPost(
        string $orderRef,
        string $orderAmount,
        string $orderCurrency,
        string $refundAmount
    ): ?InstantRefundNotification;

    public function instantOrderStatusPost(string $refNoExt): ?InstantOrderStatus;

    public function parseResponseBody(string $xml): array;

    /**
     * @return string[]
     */
    public function parseResponseString(string $xml, string $dateKey): array;

    public function isInstantPaymentNotificationValid(string $requestBody): bool;

    public function getInstantPaymentNotificationSuccessResponse(InstantPaymentNotification $ipn): array;

    public function getInstantPaymentNotificationFailedResponse(): array;

    public function isPaymentSuccess(string $returnCode): bool;

    /**
     * @return $this
     */
    public function validateStatusCode(array $values);

    /**
     * @return $this
     */
    public function validateHash(string $hash, array $values);

    /**
     * @return $this
     */
    public function validateResponseStatusCode(int $statusCode);

    public function parseBackRefRequest(string $url): Backref;

    public function parseInstantPaymentNotificationRequest(string $body): InstantPaymentNotification;
}