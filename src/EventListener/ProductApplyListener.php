<?php

namespace App\EventListener;

use App\Event\ProductApplyEvent;
use App\Service\ClientProductService;
use App\Service\NotificationService;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class ProductApplyListener
{
    public function __construct(
        protected readonly ClientProductService $clientProductService,
        protected readonly NotificationService $notificationService
    ) {}

    #[AsEventListener(event: ProductApplyEvent::class)]
    public function onProductApply(ProductApplyEvent $event): void
    {
        $this->clientProductService->applyProductClient($event->clientProduct);
        $this->notificationService->sendNotification($event->clientProduct);
    }
}
