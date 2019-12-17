<?php
declare(strict_types = 1);

namespace SnowIO\OrderHiveDataModel\Order;

final class OrderStatus
{
    const CONFIRM = "confirm";
    const NOT_CONFIRM = "not_confirm";
    const SHIP = "ship";
    const DELIVER = "deliver";

    const ALL = [
        self::CONFIRM,
        self::NOT_CONFIRM,
        self::SHIP,
        self::DELIVER,
    ];


    public static function validateStatus(string $status)
    {
        if (!in_array($status, self::ALL)) {
            throw new \InvalidArgumentException('Invalid Status');
        }
    }
}
