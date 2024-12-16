<?php

namespace App\Dto\ClientController\Request;

use Symfony\Component\Validator\Constraints as Assert;

abstract class AbstractClientDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 500)]
        public readonly string $name,
        
        #[Assert\NotBlank]
        #[Assert\Length(min: 2, max: 500)]
        public readonly string $surname,

        #[Assert\NotBlank]
        public readonly \DateTime $birthDate,

        #[Assert\NotBlank]
        #[Assert\Length(min: 9)]
        public readonly int $snn,

        #[Assert\NotBlank]
        #[Assert\GreaterThanOrEqual(300)]
        #[Assert\LessThanOrEqual(850)]
        public readonly int $ficoRating,

        #[Assert\NotBlank]
        #[Assert\Email]
        public readonly string $email,

        #[Assert\NotBlank]
        //TODO: needs regex for us country
        public readonly int $phoneNumber,
        
        #[Assert\NotBlank]
        //TODO: needs validation zip
        public readonly int $zip,
        
        #[Assert\NotBlank]
        //TODO: needs validation for state
        public readonly string $state,
        
        #[Assert\NotBlank]
        //TODO: needs validation for city
        public readonly string $city,
        
        #[Assert\NotBlank]
        #[Assert\Length(min: 5, max: 500)]
        public readonly string $addressLine,
        
        #[Assert\NotBlank]
        public readonly int $monthlyAmount
    ) {
    }
}