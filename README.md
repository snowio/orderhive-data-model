# orderhive-data-model

[![Build Status](https://travis-ci.com/snowio/orderhive-data-model.svg?token=KYposz2syiTEd34NCFKM&branch=master)](https://travis-ci.com/snowio/orderhive-data-model)

Data model for the Order Hive API 

Currently supports: 

- Order

Example

```php
<?php
    use SnowIO\OrderHiveDataModel\Command\CreateOrderCommand;
    use SnowIO\OrderHiveDataModel\Order\OrderStatus;
    use SnowIO\OrderHiveDataModel\Order\Order;
    use SnowIO\OrderHiveDataModel\Order\ItemSet;
    use SnowIO\OrderHiveDataModel\Order\Item;
        
    $createOrderCommand = CreateOrderCommand::of(
        Order::of(0001)
            ->withOrderStatus(OrderStatus::CONFIRM)
            ->withStoreId('1')
            ->withCurrency("USD")
            ->withTaxType("EXCLUSIVE")
            ->withOrderItems(ItemSet::of([
                Item::of(111, 1)->withPrice(1.99)->withSku('a'),
                Item::of(222, 1)->withPrice(2.99)->withSku('b'),
            ]))
    );
```