<?php

declare(strict_types = 1);

namespace Cheppers\OtpspClient\DataType;

use JsonSerializable;

class InstantPaymentNotification extends ResponseBase implements JsonSerializable
{

    /**
     * @var string
     */
    public $cardMask = '';

    /**
     * @var string
     */
    public $method = 'CARD';

    /**
     * @var string
     */
    public $finishDate = '';

    /**
     * @var string
     */
    public $expiry = '';

    /**
     * @var string
     */
    public $paymentDate = '';

    /**
     * @var string
     */
    public $status = '';

    /**
     * @var string
     */
    public $receiveDate = '';

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): mixed
    {
        $data = get_object_vars($this);

        return [
            'salt' => $data['salt'],
            'orderRef' => $data['orderRef'],
            'method' => $data['method'],
            'merchant' => $data['merchant'],
            'finishDate' => $data['finishDate'],
            'paymentDate' => $data['paymentDate'],
            'transactionId' => $data['transactionId'],
            'status' => $data['status'],
            'receiveDate' => $data['receiveDate']
        ];
    }
}
