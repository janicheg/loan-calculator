<?php

namespace App\Event;

use App\Entity\ClientProduct;
use Symfony\Contracts\EventDispatcher\Event;

class ProductApplyEvent extends Event
{
    public function __construct(
        public readonly ClientProduct $clientProduct
    ) {}
}