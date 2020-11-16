<?php
declare(strict_types = 1);
namespace SnowIO\OrderHiveDataModel\Test\Unit\Product\Configurable;

use PHPUnit\Framework\TestCase;
use SnowIO\OrderHiveDataModel\Product\Category;
use SnowIO\OrderHiveDataModel\Product\Configurable\ConfigurableProduct;
use SnowIO\OrderHiveDataModel\Product\Configurable\MemberProduct;
use SnowIO\OrderHiveDataModel\Product\Configurable\MembersSet;
use SnowIO\OrderHiveDataModel\Product\Configurable\ProductOption;
use SnowIO\OrderHiveDataModel\Product\Configurable\ProductOptionsSet;
use SnowIO\OrderHiveDataModel\Product\Configurable\ProductPrice;
use SnowIO\OrderHiveDataModel\Product\Configurable\ProductPricesSet;
use SnowIO\OrderHiveDataModel\Product\ProductStore;
use SnowIO\OrderHiveDataModel\Product\ProductStoresSet;

class ConfigurableProductTest extends TestCase
{
    private function getJsonData($modelName)
    {
        return [
            'name' => $modelName,
            'brand' => 'brand',
            'description' => 'description',
            'category' => [
                'name' => 'Category Test'
            ],
            'product_stores' => [
                [
                    'store_id' => 46670,
                    'price' => null,
                ]
            ],
            'product_options' => [
                [
                    'name' => 'Color',
                    'position' => 1
                ],
                [
                    'name' => 'Size',
                    'position' => 2
                ]
            ],
            'members' => [
                [
                    'name' => 'simple name 1',
                    'sku' => 'simple sku 1',
                    'option1' => 'Black',
                    'option2' => 'L',
                    'option3' => null,
                    'option4' => null,
                    'option5' => null,
                    'product_stores' => [
                        [
                            'store_id' => 46670,
                            'price' => '90'
                        ]
                    ],
                    'product_prices' => [
                        [
                            'price_id' => 1,
                            'price' => '90'
                        ],
                        [
                            'price_id' => 2,
                            'price' => '100'
                        ]
                    ],
                    'custom_fields' => []
                ],
                [
                    'name' => 'simple name 2',
                    'sku' => 'simple sku 2',
                    'option1' => 'Black',
                    'option2' => 'M',
                    'option3' => null,
                    'option4' => null,
                    'option5' => null,
                    'product_stores' => [
                        [
                            'store_id' => 46670,
                            'price' => '90'
                        ]
                    ],
                    'product_prices' => [
                        [
                            'price_id' => 1,
                            'price' => '90'
                        ],
                        [
                            'price_id' => 2,
                            'price' => '100'
                        ]
                    ],
                    'custom_fields' => []
                ]
            ]
        ];
    }

    public function testFromJsonToJson()
    {
        $data = $this->getJsonData('model');

        $order = ConfigurableProduct::fromJson($data);

        self::assertEquals($data, $order->toJson());
    }

    public function testWithers()
    {
        $product = ConfigurableProduct::of('configurable name')
            ->withCategory(Category::of('Category Test'))
            ->withBrand('brand')
            ->withDescription('description')
            ->withProductStores(ProductStoresSet::of([
                ProductStore::of(46670)
            ]))
            ->withProductOptions(ProductOptionsSet::of([
                ProductOption::of('Color')->withPosition(1),
                ProductOption::of('Size')->withPosition(2),
            ]))
            ->withMembers(MembersSet::of([
                MemberProduct::of('simple sku 1')
                    ->withName('simple name 1')
                    ->withOption1('Black')
                    ->withOption2('L')
                    ->withProductStores(ProductStoresSet::of([
                        ProductStore::of(46670)->withPrice('90')
                    ]))
                    ->withProductPrices(ProductPricesSet::of([
                        ProductPrice::of(1)->withPrice('90'),
                        ProductPrice::of(2)->withPrice('100')
                    ])),
                MemberProduct::of('simple sku 2')
                    ->withName('simple name 2')
                    ->withOption1('Black')
                    ->withOption2('M')
                    ->withProductStores(ProductStoresSet::of([
                        ProductStore::of(46670)->withPrice('90')
                    ]))
                    ->withProductPrices(ProductPricesSet::of([
                        ProductPrice::of(1)->withPrice('90'),
                        ProductPrice::of(2)->withPrice('100')
                    ]))
            ]));

        self::assertEquals($this->getJsonData('configurable name'), $product->toJson());
    }

    public function testGetters()
    {
        $data = $this->getJsonData('name');
        $product = ConfigurableProduct::fromJson($data);

        self::assertEquals($product->getName(), 'name');
        self::assertEquals($product->getBrand(), 'brand');
        self::assertEquals($product->getDescription(), 'description');
        self::assertEquals($product->getCategory(), Category::of('Category Test'));
        self::assertEquals($product->getProductStores(), ProductStoresSet::of([
            ProductStore::of(46670)
        ]));

        self::assertEquals($product->getProductOptions(), ProductOptionsSet::of([
            ProductOption::of('Color')->withPosition(1),
            ProductOption::of('Size')->withPosition(2),
        ]));

        self::assertEquals($product->getMembers(), MembersSet::of([
            MemberProduct::of('simple sku 1')
                ->withName('simple name 1')
                ->withOption1('Black')
                ->withOption2('L')
                ->withProductStores(ProductStoresSet::of([
                    ProductStore::of(46670)->withPrice('90')
                ]))
                ->withProductPrices(ProductPricesSet::of([
                    ProductPrice::of(1)->withPrice('90'),
                    ProductPrice::of(2)->withPrice('100')
                ])),
            MemberProduct::of('simple sku 2')
                ->withName('simple name 2')
                ->withOption1('Black')
                ->withOption2('M')
                ->withProductStores(ProductStoresSet::of([
                    ProductStore::of(46670)->withPrice('90')
                ]))
                ->withProductPrices(ProductPricesSet::of([
                    ProductPrice::of(1)->withPrice('90'),
                    ProductPrice::of(2)->withPrice('100')
                ]))
        ]));
    }
}
