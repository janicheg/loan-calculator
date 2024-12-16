<?php

namespace App\Service;

use App\Dto\ClientController\Request\ClientCreateDto;
use App\Dto\ClientController\Request\AbstractClientDto;
use App\Dto\ClientController\Request\ClientUpdateDto;
use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientService
{
    public function __construct(
        protected readonly EntityManagerInterface $entityManager,
        protected readonly ClientRepository $clientRepository,
    )
    {}

    public function createClient(ClientCreateDto $clientCreateDto): Client
    {
        $client = $this->getUpdatedEntity(new Client(), $clientCreateDto);
        $this->entityManager->persist($client);
        $this->entityManager->flush();

        return $client;
    }

    public function updateClient(Client $client, ClientUpdateDto $clientUpdateDto): Client
    {
        $this->getUpdatedEntity($client, $clientUpdateDto);
        $this->entityManager->flush();
        
        return $client;
    }
    
    protected function getUpdatedEntity(Client $client, AbstractClientDto $clientDto): Client
    {
        $client->setName($clientDto->name);
        $client->setSurname($clientDto->surname);
        $client->setBirthDate($clientDto->birthDate);
        $client->setEmail($clientDto->email);
        $client->setSnn($clientDto->snn);
        $client->setAddressLine($clientDto->addressLine);
        $client->setFicoRating($clientDto->ficoRating);
        $client->setPhoneNumber($clientDto->phoneNumber);
        $client->setState($clientDto->state);
        $client->setCity($clientDto->city);
        $client->setZip($clientDto->zip);
        $client->setMonthlyAmount($clientDto->monthlyAmount);
        
        return $client;
    }
}