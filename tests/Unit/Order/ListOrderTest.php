<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Order;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Order\Address;
use SnowIO\OrderHiveDataModel\Order\ItemSet;
use SnowIO\OrderHiveDataModel\Order\Item;
use SnowIO\OrderHiveDataModel\Order\ListOrder;
use SnowIO\OrderHiveDataModel\Order\ListOrderItem;
use SnowIO\OrderHiveDataModel\Order\ListOrderItemSet;
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

class ListOrderTest extends TestCase
{
    private function getJsonData($referenceNumber)
    {
        return [
            "id" => 95918468,
            "channel_order_id" => "129",
            "contact_id" => 52308715,
            "is_back_order" => false,
            "shipping_service" => null,
            "shipping_carrier" => null,
            "display_number" => "129",
            "invoice_created" => false,
            "currency" => "USD",
            "payment_method" => "Cash",
            "order_status" => "confirm",
            "custom_status" => 2,
            "payment_status" => "not_paid",
            "billing_name" => "Nei Santos",
            "shipping_name" => "Nei Santos",
            "channel_order_number" => null,
            "reference_number" => $referenceNumber,
            "channel_id" => 13,
            "store_id" => 46670,
            "store_name" => "Orderhive",
            "channel_icon" => "https://s3-ap-southeast-1.amazonaws.com/orderhive/channels/icon/13.png",
            "channel_name" => "orderhive",
            "total" => 288.51,
            "comment_count" => 0,
            "sync_created" => "2019-03-14 08:25:13",
            "is_any_unread" => false,
            "partially_cancel" => false,
            "list_order_items" => [
                [
                    "id" => 2183588741,
                    "name" => "Apple iPhone 5c 32GB Cell Phone Green",
                    "item_id" => 36076380,
                    "sku" => "DEMOPRODUCT4",
                    "quantity_ordered" => 1,
                    "quantity_shipped" => 0,
                    "item_price" => 322,
                    "row_total" => 288.51,
                    "discount_percent" => 20,
                    "discount_value" => 72.128
                ]
            ],
            "order_items_size" => 1,
            "total_qty_ordered" => 1,
            "action_required" => false,
            "warehouse_id" => 30906,
            "remark" => "",
            "fulfillment_status" => null,
            "custom_fields_listing" => null,
            "preset_id" => 0,
            "templates" => null,
            "print_status" => null,
            "sub_users" => null,
            "tags" => [],
            "created_date" => "2019-12-10 13:16:30",
            "delivery_date" => null,
            "shipping_due_date" => null,
            "modified_date" => "2019-12-10 13:16:30",
        ];
    }


    public function testFromJsonToJson()
    {
        $data = $this->getJsonData('111111');
        $order = ListOrder::fromJson($data);

        self::assertEquals($data, $order->toJson());
    }

    public function testWithers()
    {
        $order = ListOrder::of(95918468)
            ->withChannelId(129)
            ->withContactId(52308715)
            ->withIsBackOrder(false)
            ->withDisplayNumber('129')
            ->withInvoiceCreated(false)
            ->withCurrency('USD')
            ->withPaymentMethod('Cash')
            ->withOrderStatus('confirm')
            ->withCustomStatus(2)
            ->withPaymentStatus('not_paid')
            ->withBillingName('Nei Santos')
            ->withShippingName('Nei Santos')
            ->withChannelId(13)
            ->withStoreId(46670)
            ->withStoreName('Orderhive')
            ->withTotal(288.51)
            ->withCommentCount(0)
            ->withSyncCreated('2019-03-14 08:25:13')
            ->withChannelIcon("https://s3-ap-southeast-1.amazonaws.com/orderhive/channels/icon/13.png")
            ->withChannelName('orderhive')
            ->withIsAnyUnread(false)
            ->withPartiallyCancel(false)
            ->withChannelOrderId('129')
            ->withListOrderItems(ListOrderItemSet::of([
                ListOrderItem::of(2183588741)
                    ->withName('Apple iPhone 5c 32GB Cell Phone Green')
                    ->withSku('DEMOPRODUCT4')
                    ->withItemId(36076380)
                    ->withRowTotal(288.51)
                    ->withItemPrice(322)
                    ->withDiscountPercent(20)
                    ->withDiscountValue(72.128)
                    ->withQuantityOrdered(1)
                    ->withQuantityShipped(0)
            ]))
            ->withRemark('')
            ->withOrderItemsSize(1)
            ->withTotalQtyOrdered(1)
            ->withActionRequired(false)
            ->withWarehouseId(30906)
            ->withPresetId(0)
            ->withCreatedDate("2019-12-10 13:16:30")
            ->withModifiedDate("2019-12-10 13:16:30")
            ;

        self::assertEquals($this->getJsonData(null), $order->toJson());
    }

    public function testGetters()
    {
        $data = $this->getJsonData('111111');
        $order = ListOrder::fromJson($data);

        self::assertEquals($order->getId(), 95918468);
        self::assertEquals($order->getChannelId(), 13);
        self::assertEquals($order->getReferenceNumber(), '111111');
        self::assertEquals($order->getPaymentStatus(), PaymentStatus::NOT_PAID);
        self::assertEquals($order->getOrderStatus(), OrderStatus::CONFIRM);
        self::assertEquals($order->getPaymentMethod(), 'Cash');
        self::assertEquals($order->getTotal(), 288.51);
        self::assertEquals($order->getSyncCreated(), '2019-03-14 08:25:13');
        self::assertEquals($order->getRemark(), '');
        self::assertEquals($order->getStoreId(), 46670);
        self::assertEquals($order->getStoreName(), 'Orderhive');
        self::assertEquals($order->getChannelId(), 13);
        self::assertEquals($order->getContactId(), 52308715);
        self::assertEquals($order->getBillingName(), 'Nei Santos');
        self::assertEquals($order->getShippingName(), 'Nei Santos');

        self::assertEquals($order->getListOrderItems(), ListOrderItemSet::of([
            ListOrderItem::of(2183588741)
                ->withName('Apple iPhone 5c 32GB Cell Phone Green')
                ->withDiscountPercent(20)
                ->withItemId(36076380)
                ->withItemPrice(322)
                ->withQuantityOrdered(1)
                ->withQuantityShipped(0)
                ->withSku("DEMOPRODUCT4")
                ->withRowTotal(288.51)
                ->withDiscountValue(72.128)
        ]));
    }
}
