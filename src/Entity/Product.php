<?php

namespace App\Entity;

use App\Db\UuidGenerator;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[ORM\Column(name: "uuid", type: "guid")]
    private ?string $uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $term = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\Column]
    private ?float $rate = null;

    /**
     * @var Collection<int, ClientProduct>
     */
    #[ORM\OneToMany(targetEntity: ClientProduct::class, mappedBy: 'parentProduct', orphanRemoval: true)]
    #[Ignore]
    private Collection $clientProducts;

    public function __construct()
    {
        $this->clientProducts = new ArrayCollection();
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTerm(): ?int
    {
        return $this->term;
    }

    public function setTerm(int $term): static
    {
        $this->term = $term;

        return $this;
    }

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): static
    {
        $this->amount = $amount;

        return $this;
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

    /**
     * @return Collection<int, ClientProduct>
     */
    public function getClientProducts(): Collection
    {
        return $this->clientProducts;
    }

    public function addClientProduct(ClientProduct $clientProduct): static
    {
        if (!$this->clientProducts->contains($clientProduct)) {
            $this->clientProducts->add($clientProduct);
            $clientProduct->setParentProduct($this);
        }

        return $this;
    }

    public function removeClientProduct(ClientProduct $clientProduct): static
    {
        if ($this->clientProducts->removeElement($clientProduct)) {
            // set the owning side to null (unless already changed)
            if ($clientProduct->getParentProduct() === $this) {
                $clientProduct->setParentProduct(null);
            }
        }

        return $this;
    }
}
