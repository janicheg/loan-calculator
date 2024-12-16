<?php

namespace App\Event;

use App\Entity\Client;
use App\Entity\ClientProduct;
use App\Entity\Product;
use Symfony\Contracts\EventDispatcher\Event;

class ProductCheckEvent extends Event
{
    public function __construct(
        public readonly Client $client,
        public readonly Product $product,
        public ?ClientProduct $clientProduct = null
    ) {}
}