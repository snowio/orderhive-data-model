<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Order\CustomFields;
use SnowIO\OrderHiveDataModel\Order\CustomFieldsSet;
use SnowIO\OrderHiveDataModel\Order\OrderDetails\Address;
use SnowIO\OrderHiveDataModel\Order\OrderDetails\Item;
use SnowIO\OrderHiveDataModel\Order\OrderDetails\ItemSet;
use SnowIO\OrderHiveDataModel\Order\OrderDetails\Order;
use SnowIO\OrderHiveDataModel\Order\OrderDetails\Warehouse;
use SnowIO\OrderHiveDataModel\Order\OrderStatus;
use SnowIO\OrderHiveDataModel\Order\PaymentStatus;
use SnowIO\OrderHiveDataModel\Order\ProductImage;
use SnowIO\OrderHiveDataModel\Order\TaxInfo;
use SnowIO\OrderHiveDataModel\Order\TaxInfoGroup;
use SnowIO\OrderHiveDataModel\Order\TaxInfoGroupSet;

/**
 * @group orderdetails
 */
class OrderDetailsTest extends TestCase
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
            "sync_created" => "2019-03-14 08:25:13",
            "remark" => "remark",
            "store_id" => 46670,
            "channel_id" => 13,
            "contact_id" => 52308715,
            "base_currency_rate" => 1.0,
            "reference_number" => $referenceNumber,
            'id' => 1,
            "order_items" => [[
                'asin_number' => null,
                'channel_primary_id' => null,
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
                'weight' => 1.11,
                'weight_unit' => 'test',
                "name" => "Apple iPhone 5c 32GB Cell Phone Green",
                "sku" => "DEMOPRODUCT4",
                "item_id" => 123,
                "note" => "only a test",
                "quantity_ordered" => 1,
                "tax_percent" => 12.0,
                "row_total" => 288.51,
                "price" => 322.0,
                "discount_percent" => 20.0,
                "discount_value" => 72.128,
                "discount_type" => "PERCENT",
                'item_warehouse' => null,
                'quantity_cancelled' => 0,
                'quantity_shipped' => 0,
                'quantity_available' => 0,
                'quantity_on_hand' => 0,
                'quantity_returned' => 0,
                'quantity_delivered' => 0,
                'quantity_packed' => 0,
                'quantity_dropshipped' => 0,
                'last_purchase_price' => null,
                'brand' => null,
                'category' => null,
                'default_supplier_id' => null,
                'type' => null,
                'suppliers' => [],
                'serial_numbers' => null,
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
                "email" => "ns@amp.co",
                "default" => null,
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
                "email" => "ns@amp.co",
                "default" => null,
                "contact_number" => "xxxxxxxxx"
            ],
            "warehouse" => [
                "id" => 1,
                "is_default" => null,
                "name" => null,
                "type" => null,
                "country_name" => null,
                "contact_no" => null,
                "dropshipper_policy" => null,
            ],
            "is_back_order" => null,
            "shipping_service" => null,
            "shipping_carrier" => null,
            "display_number" => null,
            "invoice_created" => null,
            "custom_status" => null,
            "billing_name" => null,
            "shipping_name" => null,
            "channel_order_number" => null,
            "channel_order_id" => null,
            "store_name" => null,
            "channel_icon" => null,
            "channel_name" => null,
            "total" => 0.0,
            "comment_count" => 0,
            "is_any_unread" => null,
            "partially_cancel" => null,
            "action_required" => null,
            "suffix" => null,
            "prefix" => null,
            "shipment" => null,
            "sales_person" => null,
            "preset_id" => null,
            "fulfillment_status" => null,
            "custom_fields" => [
                ["name" => "PO", "type" => "TEXT", "value" => "123"]
            ],
            "unread_comment_count" => 0,
            "custom_pricing_tier_id" => null,
            "templates" => null,
            "print_status" => null,
            "sub_users" => null,
            "tags" => array(),
            "order_extra_items" => array(),
            "tax_calculation" => null,
            "valid_shipping_address" => null,
            "shipping_address_type" => null,
            "split_order" => null,
            "mcf_status" => null,
            "export_type" => null,
            "discount_code" => null,
            "created_date" => null,
            "sync_modified" => null,
            "hold_date" => null,
            "shipping_due_date" => null,
            "modified_date" => null,
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
            ->withPaymentStatus(PaymentStatus::NOT_PAID)
            ->withOrderStatus(OrderStatus::CONFIRM)
            ->withPaymentMethod('Cash')
            ->withWarehouseId(30906)
            ->withDeliveryDate('2019-10-10')
            ->withSyncCreated('2019-03-14 08:25:13')
            ->withRemark('remark')
            ->withReferenceNumber('22')
            ->withTaxType('EXCLUSIVE')
            ->withChannelId(13)
            ->withBaseCurrencyRate(1)
            ->withContactId(52308715)
            ->withCurrency('USD')
            ->withCustomFields(CustomFieldsSet::of([
                CustomFields::of('PO', CustomFields::TYPE_TEXT, '123')
            ]))
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
                    ->withTaxValue(1.11)
                    ->withDiscountPercent(20)
                    ->withDiscountValue(72.128)
                    ->withDiscountType('PERCENT')
                    ->withQuantityInvoiced(1)
                    ->withQuantityShipped(0)
                    ->withQuantityCancelled(0)
                    ->withQuantityAvailable(0)
                    ->withQuantityReturned(0)
                    ->withQuantityPacked(0)
                    ->withQuantityOnHand(0)
                    ->withQuantityDelivered(0)
                    ->withQuantityDropShipped(0)
                    ->withTaxInfo(TaxInfo::of(1)->withTaxRate(1)->withGroups(TaxInfoGroupSet::of([
                        TaxInfoGroup::of(1)->withName('name')->withTaxRate(0)->withTotalTaxValue(0)
                    ])))
                    ->withTaxPercent(12)
                    ->withSuppliers([])
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
            )
            ->withWarehouse(Warehouse::of(1))
            ->withUnreadCommentCount(0)
            ->withTotal(0)
            ->withCommentCount(0);

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
        self::assertEquals($order->getSyncCreated(), '2019-03-14 08:25:13');
        self::assertEquals($order->getRemark(), 'remark');
        self::assertEquals($order->getStoreId(), 46670);
        self::assertEquals($order->getChannelId(), 13);
        self::assertEquals($order->getContactId(), 52308715);

        self::assertEquals($order->getBaseCurrencyRate(), 1);
        self::assertEquals($order->getReferenceNumber(), '111111');
        self::assertEquals($order->getId(), 1);

        foreach ($order->getOrderItems() as $item) {
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
                ->withQuantityCancelled(0)
                ->withQuantityShipped(0)
                ->withQuantityAvailable(0)
                ->withQuantityOnHand(0)
                ->withQuantityReturned(0)
                ->withQuantityDelivered(0)
                ->withQuantityPacked(0)
                ->withQuantityDropShipped(0)
                ->withTaxValue(1.11)
                ->withSku('DEMOPRODUCT4')
                ->withTaxInfo(TaxInfo::of(1)->withTaxRate(1)->withGroups(TaxInfoGroupSet::of([
                    TaxInfoGroup::of(1)->withTaxRate(0.0)->withName('name')->withTotalTaxValue(0.0)
                ])))
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
