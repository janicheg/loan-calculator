<?php
namespace App\Controller;

;

use App\Dto\ClientController\Request\ClientCreateDto;
use App\Dto\ClientController\Request\ClientUpdateDto;
use App\Entity\Client;
use App\Service\ClientService;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/client')]
class ClientController extends AbstractController
{

    public function __construct(protected readonly ClientService $clientService)
    {}

    #[Route('/create', methods: ['POST'])]
    public function createClient(
        #[MapRequestPayload] ClientCreateDto $clientCreateDto
    ): Response
    {
        //TODO: add response DTO
        //TODO: send event instead of using service
        return $this->json(
            $this->clientService->createClient($clientCreateDto)
        );
    }

    #[Route('/update/{clientId}', methods: ['PATCH'])]
    public function updateClient(
        #[MapRequestPayload] ClientUpdateDto $clientUpdateDto,
        #[MapEntity(mapping: ['clientId' => 'uuid'])] Client $client
    ): Response
    {
        //TODO: add response DTO
        //TODO: send event instead of using service
        return $this->json(
            $this->clientService->updateClient($client, $clientUpdateDto)
        );
    }
}