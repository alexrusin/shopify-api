<?php

namespace Tests;

use LukeTowers\ShopifyPHP\Shopify;
use Apr\ShopifyApi\Decorators\IteratorDecorator;
use Mockery as m;

class ShopifyProductsTest extends TestCase 
{
    /** @test */
    public function it_gets_products()
    {   
        $api = m::mock(Shopify::class)->makePartial();
        $api->shouldReceive('call')
            ->times(3)
            ->andReturn(
                (object) [
                    'count' => 150
                ],

                (object) [
                    'products' => [
                        (object) [
                            'id' => 1
                        ]
                    ]
                ],
                (object) [
                    'products' => [
                        (object) [
                            'id' => 2
                        ]
                    ]
                ]

            );

        $iterator = new IteratorDecorator($api);
        $ids = [];
        foreach ($iterator->getProducts() as $products) {
            $ids[] = $products[0]->id;
        }
        
        $this->assertEquals(2, count($ids));
        $this->assertEquals(1, $ids[0]);
        $this->assertEquals(2, $ids[1]);

    }

    /** @test */
    public function it_gets_products_with_set_per_page()
    {   
        $api = m::mock(Shopify::class)->makePartial();
        $api->shouldReceive('call')
            ->times(3)
            ->andReturn(
                (object) [
                    'count' => 78
                ],

                (object) [
                    'products' => [
                        (object) [
                            'id' => 1
                        ]
                    ]
                ],
                (object) [
                    'products' => [
                        (object) [
                            'id' => 2
                        ]
                    ]
                ]

            );

        $iterator = new IteratorDecorator($api);
        $ids = [];
        foreach ($iterator->getProducts(50) as $products) {
            $ids[] = $products[0]->id;
        }
        
        $this->assertEquals(2, count($ids));
        $this->assertEquals(1, $ids[0]);
        $this->assertEquals(2, $ids[1]);

    }
}
