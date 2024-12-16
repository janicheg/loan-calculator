<?php

namespace App\EventListener;

use App\Entity\ClientProduct;
use App\Event\ProductCheckEvent;
use App\Service\ClientProductService;
use App\Service\ProductCalculateService;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class ProductCheckListener
{
    public function __construct(
        protected readonly ProductCalculateService $productService,
        protected readonly ClientProductService $clientProductService
    ) {}

    #[AsEventListener(event: ProductCheckEvent::class)]
    public function onProductCheck(ProductCheckEvent $event): void
    {
        $clientProduct = $this->clientProductService->findDraftProductByClient(
            $event->client,
            $event->product
        );
        
        if (!$clientProduct instanceof ClientProduct) {
            $clientProduct = $this->productService->calculateProductForClient(
                $event->client,
                $event->product,
            );
            $this->clientProductService->saveProductClient($clientProduct);
        }
        
        $event->clientProduct = $clientProduct;
    }
}
