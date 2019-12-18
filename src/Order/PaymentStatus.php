<?php
declare(strict_types = 1);

namespace SnowIO\OrderHiveDataModel\Order;

final class PaymentStatus
{
    const PAID = "paid";
    const NOT_PAID = "not_paid";
    const PARTIAL_PAID = "partial_paid";

    const ALL = [
        self::PAID,
        self::NOT_PAID,
        self::PARTIAL_PAID,
    ];

    public static function validateStatus(string $status)
    {
        if (!in_array($status, self::ALL)) {
            throw new \InvalidArgumentException('Invalid Status');
        }
    }
}
