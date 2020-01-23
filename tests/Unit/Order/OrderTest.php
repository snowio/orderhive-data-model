<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Order\Address;
use SnowIO\OrderHiveDataModel\Order\ItemSet;
use SnowIO\OrderHiveDataModel\Order\Item;
use SnowIO\OrderHiveDataModel\Order\OrderCredit;
use SnowIO\OrderHiveDataModel\Order\OrderStatus;
use SnowIO\OrderHiveDataModel\Order\Payment;
use SnowIO\OrderHiveDataModel\Order\PaymentSet;
use SnowIO\OrderHiveDataModel\Order\OrderCreditSet;
use SnowIO\OrderHiveDataModel\Order\Order;
use SnowIO\OrderHiveDataModel\Order\PaymentStatus;
use SnowIO\OrderHiveDataModel\Order\ProductImage;
use SnowIO\OrderHiveDataModel\Order\TaxInfo;
use SnowIO\OrderHiveDataModel\Order\TaxInfoGroup;
use SnowIO\OrderHiveDataModel\Order\TaxInfoGroupSet;

class OrderTest extends TestCase
{

    private function getJsonData($referenceNumber)
    {
        return [
            "currency" => "USD",
            "tax_type" => "EXCLUSIVE",
            "payment_status" => "not_paid",
            "order_status" => "confirm",
            "warehouse_id" => 30906,
            "payment_method" => "Cash",
            "delivery_date" => "2019-10-10",
            "grand_total" => 288.51,
            "sync_created" => "2019-03-14 08:25:13",
            "remark" => "remark",
            "store_id" => 46670,
            "channel_id" => 13,
            "contact_id" => 52308715,
            "base_currency_rate" => 1,
            "base_currency" => "USD",
            "reference_number" => $referenceNumber,
            'channel_primary_id' => null,
            'channel_secondary_id' => null,
            'components' => null,
            'id' => 1,
            'item_warehouse' => null,
            'meta_data' => 'test',
            'quantity_invoiced' => null,
            'tax_info' => [
                'id' => 1,
                'tax_rate' => 1,
                'groups' => [[
                    'id' => 1,
                    'name' => 'name',
                    'tax_rate' => 0,
                    'total_tax_value' => 0
                ]],
            ],
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
                'id' => 9,
                'meta_data' => 'test',
                'product_image' => [
                    'default_image' => 'default image',
                    'id' => 1,
                    'thumbnail' => 'thumb',
                    'url' => 'url',
                ],
                'quantity_invoiced' => 1,
                'tax_info' => [
                    'id' => 1,
                    'tax_rate' => 1,
                    'groups' => [[
                        'id' => 1,
                        'name' => 'name',
                        'tax_rate' => 0,
                        'total_tax_value' => 0
                    ]],
                ],
                'tax_value' => 1.11,
                'update_type' => 'test',
                'weight' => 1.11,
                'weight_unit' => 'test',
                "name" => "Apple iPhone 5c 32GB Cell Phone Green",
                "sku" => "DEMOPRODUCT4",
                "item_id" => 123,
                "note" => "only a test",
                "quantity_ordered" => 1,
                "tax_percent" => 12,
                "row_total" => 288.51,
                "price" => 322.0,
                "discount_percent" => 20,
                "discount_value" => '72.128',
                "discount_type" => "PERCENT",
                'item_warehouse' => null,
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
                "company" => "company",
                "created" => 1,
                "id" => 1,
                "modified" => 1,
                "email" => "ns@amp.co",
                "contact_number" => "xxxxxxxxx"
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
                "company" => "company",
                "created" => 1,
                "id" => 2,
                "modified" => 1,
                "email" => "ns@amp.co",
                "contact_number" => "xxxxxxxxx"
            ]
        ];
    }


    public function testFromJsonToJson()
    {
        $data = $this->getJsonData('111111');
        $order = Order::fromJson($data);

        self::assertEquals($data, $order->toJson());
    }

    public function testWithers()
    {
        $order = Order::of(1)
            ->withStoreId(46670)
            ->withTaxType('EXCLUSIVE')
            ->withPaymentStatus(PaymentStatus::NOT_PAID)
            ->withOrderStatus(OrderStatus::CONFIRM)
            ->withPaymentMethod('Cash')
            ->withWarehouseId(30906)
            ->withDeliveryDate('2019-10-10')
            ->withGrandTotal(288.51)
            ->withSyncCreated('2019-03-14 08:25:13')
            ->withRemark('remark')
            ->withReferenceNumber('22')
            ->withMetaData('test')
            ->withChannelId(13)
            ->withContactId(52308715)
            ->withBaseCurrencyRate(1)
            ->withBaseCurrency('USD')
            ->withCurrency('USD')
            ->withTaxInfo(TaxInfo::of(1)->withTaxRate(1)->withGroups(TaxInfoGroupSet::of([
                TaxInfoGroup::of(1)->withName('name')
            ])))
            ->withOrderItems(ItemSet::of([
                Item::of(123, 1)
                    ->withName('Apple iPhone 5c 32GB Cell Phone Green')
                    ->withSku('DEMOPRODUCT4')
                    ->withNote('only a test')
                    ->withProductImage(
                        ProductImage::of(1)
                            ->withDefaultImage('default image')
                            ->withThumbnail('thumb')
                            ->withUrl('url')
                    )
                    ->withTaxPercent(12)
                    ->withId(9)
                    ->withMetaData('test')
                    ->withRowTotal(288.51)
                    ->withPrice(322)
                    ->withWeightUnit('test')
                    ->withWeight(1.11)
                    ->withTaxInfo(TaxInfo::of(1)->withTaxRate(1)->withGroups(TaxInfoGroupSet::of([
                        TaxInfoGroup::of(1)->withName('name')
                    ])))
                    ->withTaxValue(1.11)
                    ->withUpdateType('test')
                    ->withDiscountPercent(20)
                    ->withDiscountValue(72.128)
                    ->withDiscountType('PERCENT')
                    ->withQuantityInvoiced(1)
            ]))
            ->withShippingAddress(
                Address::of(1)
                    ->withAddress1('29/A Bhavana Society, Opp Mangal Park')
                    ->withAddress2('Gita Mandir Road')
                    ->withCity('Ahmedabad')
                    ->withCountry('India')
                    ->withCountryCode('IN')
                    ->withState('Gujarat')
                    ->withZipcode('380022')
                    ->withName('Nei Santos')
                    ->withCompany('company')
                    ->withCreated('1')
                    ->withId(1)
                    ->withModified('1')
                    ->withEmail('ns@amp.co')
                    ->withContactNumber('xxxxxxxxx')
            )
            ->withBillingAddress(
                Address::of(2)
                    ->withAddress1('29/A Bhavana Society, Opp Mangal Park')
                    ->withAddress2('Gita Mandir Road')
                    ->withCity('Ahmedabad')
                    ->withCountry('India')
                    ->withCountryCode('IN')
                    ->withState('Gujarat')
                    ->withZipcode('380022')
                    ->withName('Nei Santos')
                    ->withCompany('company')
                    ->withCreated('1')
                    ->withId(2)
                    ->withModified('1')
                    ->withEmail('ns@amp.co')
                    ->withContactNumber('xxxxxxxxx')
            );

        self::assertEquals($this->getJsonData($refNumber='22'), $order->toJson());
    }

    public function testGetters()
    {
        $data = $this->getJsonData('111111');
        $order = Order::fromJson($data);

        self::assertEquals($order->getCurrency(), 'USD');
        self::assertEquals($order->getTaxType(), 'EXCLUSIVE');
        self::assertEquals($order->getReferenceNumber(), '111111');
        self::assertEquals($order->getPaymentStatus(), PaymentStatus::NOT_PAID);
        self::assertEquals($order->getOrderStatus(), OrderStatus::CONFIRM);
        //self::assertEquals($order->getItemWarehouse(), OrderStatus::CONFIRM);
        self::assertEquals($order->getPaymentMethod(), 'Cash');
        self::assertEquals($order->getDeliveryDate(), '2019-10-10');
        self::assertEquals($order->getGrandTotal(), 288.51);
        self::assertEquals($order->getSyncCreated(), '2019-03-14 08:25:13');
        self::assertEquals($order->getRemark(), 'remark');
        self::assertEquals($order->getStoreId(), 46670);
        self::assertEquals($order->getChannelId(), 13);
        self::assertEquals($order->getContactId(), 52308715);

        self::assertEquals($order->getBaseCurrencyRate(), 1);
        self::assertEquals($order->getBaseCurrency(), 'USD');
        self::assertEquals($order->getReferenceNumber(), '111111');
        self::assertEquals($order->getChannelSecondaryId(), null);
        self::assertEquals($order->getComponents(), null);
        self::assertEquals($order->getId(), 1);
        self::assertEquals($order->getMetaData(), 'test');
        self::assertEquals($order->getQuantityInvoiced(), null);
        self::assertEquals($order->getTaxInfo(),
                    TaxInfo::of(1)
                        ->withTaxRate(1)
                        ->withGroups(TaxInfoGroupSet::of([
                            TaxInfoGroup::of(1)
                                ->withName('name')
                                ->withTaxRate(0)
                                ->withTotalTaxValue(0)
                        ])));

        self::assertEquals($order->getTaxValue(), null);
        self::assertEquals($order->getUpdateType(), null);
        self::assertEquals($order->getWeight(), null);
        self::assertEquals($order->getWeightUnit(), null);

        foreach($order->getOrderItems() as $item){
            self::assertSame($item->getQuantityOrdered(), 1);
            self::assertSame($item->getPrice(), 322.0);
            self::assertSame($item->getDiscountValue(), 72.128);
        }

        self::assertEquals($order->getOrderItems(), ItemSet::of([
            Item::of(123, 1)
                ->withId(9)
                ->withName('Apple iPhone 5c 32GB Cell Phone Green')
                ->withNote('only a test')
                ->withProductImage(
                    ProductImage::of(1)
                        ->withDefaultImage('default image')
                        ->withThumbnail('thumb')
                        ->withUrl('url')
                )
                ->withPrice(322.0)
                ->withRowTotal(288.51)
                ->withMetaData('test')
                ->withQuantityInvoiced(1)
                ->withTaxInfo(
                    TaxInfo::of(1)
                        ->withTaxRate(1)
                        ->withGroups(TaxInfoGroupSet::of([
                            TaxInfoGroup::of(1)
                                ->withName('name')
                                ->withTaxRate(0)
                                ->withTotalTaxValue(0)
                        ]))
                )
                ->withTaxValue(1.11)
                ->withUpdateType('test')
                ->withSku('DEMOPRODUCT4')
                ->withTaxPercent(12)
                ->withTaxValue(1.11)
                ->withWeight(1.11)
                ->withWeightUnit('test')
                ->withDiscountPercent(20)
                ->withDiscountType('PERCENT')
                ->withDiscountValue(72.128)
        ]));
    }
}
