<?php
namespace App\Controller;

use App\Entity\Client;
use App\Entity\ClientProduct;
use App\Entity\Product;
use App\Event\ProductApplyEvent;
use App\Event\ProductCheckEvent;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/product')]
class ProductController extends AbstractController
{

    public function __construct(
        protected readonly EventDispatcherInterface $eventDispatcher
    ) {}

    #[Route('/{productId}/check/{clientId}', methods: ['POST'])]
    public function checkProduct(
        #[MapEntity(mapping: ['clientId' => 'uuid'])] Client $client,
        #[MapEntity(mapping: ['productId' => 'uuid'])] Product $product
    ): Response {

        $event = new ProductCheckEvent($client, $product);
        $this->eventDispatcher->dispatch($event);

        //TODO: send DTO instead of entity 
        // sorry guys, but it is really boring to create dto for test task
        return $this->json($event->clientProduct);
    }

    #[Route('/apply/{clientProductId}', methods: ['POST'])]
    public function applyProduct(
        #[MapEntity(mapping: ['clientProductId' => 'uuid'])] ClientProduct $clientProduct
    ): Response {

        $event = new ProductApplyEvent($clientProduct);
        $this->eventDispatcher->dispatch($event);

        //TODO: send DTO instead of entity 
        // sorry guys, but it is really boring to create dto for test task
        return $this->json($event->clientProduct);
    }
}