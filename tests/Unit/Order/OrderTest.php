<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Order\ItemSet;
use SnowIO\OrderHiveDataModel\Order\Item;
use SnowIO\OrderHiveDataModel\Order\OrderCredit;
use SnowIO\OrderHiveDataModel\Order\Payment;
use SnowIO\OrderHiveDataModel\Order\PaymentSet;
use SnowIO\OrderHiveDataModel\Order\OrderCreditSet;
use SnowIO\OrderHiveDataModel\Order\Order;

class OrderTest extends TestCase
{

    private function getJsonData($referenceNumber)
    {
        return [
            "currency" => "USD",
            "tax_type" => "EXCLUSIVE",
            "payment_status" => "NOT_PAID",
            "order_status" => "confirm",
            "warehouse_id" => 30906,
            "payment_method" => "Cash",
            "delivery_date" => null,
            "grand_total" => "288.51",
            "sync_created" => "2019-03-14 08:25:13",
            "remark" => "",
            "store_id" => "46670",
            "channel_id" => 13,
            "contact_id" => 52308715,
            "base_currency_rate" => 1,
            "base_currency" => "USD",
            "reference_number" => $referenceNumber,
            'channel_primary_id' => null,
            'channel_secondary_id' => null,
            'components' => null,
            'id' => null,
            'item_warehouse' => null,
            'meta_data' => null,
            'product_image' => null,
            'quantity_invoiced' => null,
            'tax_info' => null,
            'tax_value' => null,
            'update_type' => null,
            'weight' => null,
            'weight_unit' => null,
            "order_items" => [[
                'asin_number' => null,
                'channel_primary_id' => null,
                'reference_number' => null,
                'channel_secondary_id' => null,
                'components' => null,
                'barcode' => null,
                'id' => null,
                'item_warehouse' => null,
                'meta_data' => null,
                'product_image' => null,
                'quantity_invoiced' => null,
                'tax_info' => null,
                'tax_value' => null,
                'update_type' => null,
                'weight' => null,
                'weight_unit' => null,
                "name" => "Apple iPhone 5c 32GB Cell Phone Green",
                "sku" => "DEMOPRODUCT4",
                "item_id" => '001',
                "note" => "only a test",
                "quantity_ordered" => 1,
                "tax_percent" => 12,
                "row_total" => "288.51",
                "price" => "322",
                "discount_percent" => 20,
                "discount_value" => 72.128,
                "discount_type" => "PERCENT"
            ]],
            "shipping_address" => [
                "address1" => "29/A Bhavana Society, Opp Mangal Park",
                "address2" => "Gita Mandir Road",
                "city" => "Ahmedabad",
                "country" => "India",
                "country_code" => "IN",
                "state" => "Gujarat",
                "zipcode" => "380022",
                "name" => "Nei Santos",
                "company" => "",
                "created" => "",
                "id" => "0",
                "modified" => time(),
                "email" => "ns@amp.co",
                "contact_number" => ""
            ],
            "billing_address" => [
                "address1" => "29/A Bhavana Society, Opp Mangal Park",
                "address2" => "Gita Mandir Road",
                "city" => "Ahmedabad",
                "country" => "India",
                "country_code" => "IN",
                "state" => "Gujarat",
                "zipcode" => "380022",
                "name" => "Nei Santos",
                "company" => "",
                "created" => "",
                "id" => "0",
                "modified" => time(),
                "email" => "ns@amp.co",
                "contact_number" => ""
            ]
        ];
    }


    public function testFromJsonToJson()
    {
        $data = $this->getJsonData('111111');
        $order = Order::fromJson($data);

        self::assertEquals($data, $order->toJson());
    }

    /*
    public function testWithers()
    {
        $order = Order::of('REF01')
            ->withStoreId(2)
            ->withCurrency('USD')
            ->withOrderItems(ItemSet::of([
                Item::of(1, 1)
                    ->withName('name')
            ]));

        self::assertEquals($this->getJsonData('22'), $order->toJson());
    }

    public function testGetters()
    {
        $data = $this->getJsonData('111111');
        $order = Order::fromJson($data);

        self::assertEquals($order->getCurrency(), 'USD');
        self::assertEquals($order->getTaxType(), 'EXCLUSIVE');
        self::assertEquals($order->getReferenceNumber(), '111111');
    }
    */
}
