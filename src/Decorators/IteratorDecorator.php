<?php

namespace Apr\ShopifyApi\Decorators;

class IteratorDecorator
{
    private $api;

    public function __construct($api) 
    {
        $this->api = $api;
    }

    public function getProducts(int $perPage = 100)
    {
        $page = 1;
        
        $result = $this->api->call('GET', "admin/products/count.json");
        $totalPages = ceil($result->count/$perPage);

        for ($i = 1; $i <= $totalPages; $i++) {
            usleep(500000);
            $result = $this->api->call('GET', "admin/products.json", 
                [
                    'limit' => $perPage,
                    'page'=>$page
                ]
            );

            yield $result->products;
            $page ++;
        }
      
    }
}