<?php

namespace App\Service;

use App\Entity\Client;
use App\Entity\ClientProduct;
use App\Entity\Product;
use App\Repository\ClientProductRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientProductService
{
    public function __construct(
        protected readonly EntityManagerInterface $entityManager,
        protected readonly ClientProductRepository$clientProductRepository
    ) {}

    public function saveProductClient(ClientProduct $clientProduct): void
    {
        $this->entityManager->persist($clientProduct);
        $this->entityManager->flush();
    }

    public function applyProductClient(ClientProduct $clientProduct): void
    {
        $clientProduct->setApplied(true);
        $this->entityManager->flush();
    }

    public function findDraftProductByClient(Client $client, Product $product): ?ClientProduct
    {
        return $this->clientProductRepository->findOneBy([
            'client' => $client,
            'parentProduct' => $product,
            'isApplied' => false
        ]);
    }
}