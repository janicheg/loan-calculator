<?php

namespace App\Entity;

use App\Db\UuidGenerator;
use App\Repository\ClientProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientProductRepository::class)]
class ClientProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[ORM\Column(name: "uuid", type: "guid")]
    private ?string $uuid = null;

    #[ORM\Column]
    private ?float $rate = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(name: 'client_uuid', referencedColumnName: 'uuid', nullable: false)]
    private ?Client $client = null;

    #[ORM\ManyToOne(inversedBy: 'clientProducts')]
    #[ORM\JoinColumn(name: 'parent_product_uuid', referencedColumnName: 'uuid', nullable: false)]
    private ?Product $parentProduct = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createTime = null;

    #[ORM\Column]
    private bool $isApplied = false;

    /**
     * @param \DateTimeInterface|null $createTime
     */
    public function __construct()
    {
        $this->createTime = new \DateTime();
    }


    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): static
    {
        $this->rate = $rate;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function getParentProduct(): ?Product
    {
        return $this->parentProduct;
    }

    public function setParentProduct(?Product $parentProduct): static
    {
        $this->parentProduct = $parentProduct;

        return $this;
    }

    public function getCreateTime(): ?\DateTimeInterface
    {
        return $this->createTime;
    }

    public function setCreateTime(?\DateTimeInterface $createTime): void
    {
        $this->createTime = $createTime;
    }

    public function isApplied(): ?bool
    {
        return $this->isApplied;
    }

    public function setApplied(bool $isApplied): static
    {
        $this->isApplied = $isApplied;

        return $this;
    }
}
