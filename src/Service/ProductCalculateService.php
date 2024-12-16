<?php

namespace App\Service;

use App\Entity\Client;
use App\Entity\ClientProduct;
use App\Entity\Product;
use App\Exception\ProductNotAvailableForClient;

class ProductCalculateService
{
    protected const NY = 'NY';
    protected const NV = 'NV';
    protected const CA = 'CA';
    
    protected static array $availableStates = [
        self::CA, self::NY, self::CA
    ];
    protected static array $stateRateBonus = [
        self::CA => 11.49,
        self::NY => 0,
        self::NV => 0
    ];

    public function calculateProductForClient(Client $client, Product $product): ClientProduct
    {
        $this->checkAge($client->getBirthDate());
        $this->checkMonthlyAmount($client->getMonthlyAmount());
        $this->checkFicoRating($client->getFicoRating());
        $this->checkState($client->getState());
        
        $clientProduct =  new ClientProduct();
        $clientProduct->setClient($client);
        $clientProduct->setParentProduct($product);
        $clientProduct->setRate(
            $this->calculateRate($client, $product)
        );
        $clientProduct->setApplied(false);
        
        return $clientProduct;
    }
    
    protected function checkState(string $state): void
    {
        if (in_array($state, self::$availableStates)) {
            if ($state === self::NY && rand(0,1) === 0) {
                throw new ProductNotAvailableForClient();
            }
        }
    }
    
    protected function checkFicoRating(int $rating): void
    {
        if ($rating <= 500) {
            throw new ProductNotAvailableForClient('Bad Fico rating'); 
        }
    }
    
    protected function checkMonthlyAmount(int $amount): void
    {
        //TODO: calculate amount include applied loans
        if ($amount < 1000) {
            throw new ProductNotAvailableForClient('Monthly amount too low');
        }
    }
    
    protected function checkAge(\DateTimeInterface $birthdate): void
    {
        $age = (new \DateTime())->diff($birthdate)->format('%y');
        if ($age < 18 || $age > 60) {
            throw new ProductNotAvailableForClient('Bad Age');
        }
    }
    
    protected function calculateRate(Client $client, Product $product): float
    {
        return $product->getRate() + self::$stateRateBonus[$client->getState()];
    }
}