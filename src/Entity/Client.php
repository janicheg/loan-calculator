<?php

namespace App\Entity;

use App\Db\UuidGenerator;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[ORM\Column(name: "uuid", type: "guid")]
    private ?string $uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surname = null;

    #[ORM\Column]
    private ?int $snn = null;

    #[ORM\Column]
    private ?int $ficoRating = null;

    #[ORM\Column(length: 500)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $phoneNumber = null;

    #[ORM\Column]
    private ?int $zip = null;

    #[ORM\Column(length: 2)]
    private ?string $state = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 500)]
    private ?string $addressLine = null;

    /**
     * @var Collection<int, ClientProduct>
     */
    #[ORM\OneToMany(targetEntity: ClientProduct::class, mappedBy: 'client', orphanRemoval: true)]
    #[Ignore]
    private Collection $products;

    #[ORM\Column]
    private ?int $monthlyAmount = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthDate = null;

    public function __construct()
    {
        $this->products = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getSnn(): ?int
    {
        return $this->snn;
    }

    public function setSnn(int $snn): static
    {
        $this->snn = $snn;

        return $this;
    }

    public function getFicoRating(): ?int
    {
        return $this->ficoRating;
    }

    public function setFicoRating(int $ficoRating): static
    {
        $this->ficoRating = $ficoRating;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?int
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(int $phoneNumber): static
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getZip(): ?int
    {
        return $this->zip;
    }

    public function setZip(int $zip): static
    {
        $this->zip = $zip;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): static
    {
        $this->state = $state;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getAddressLine(): ?string
    {
        return $this->addressLine;
    }

    public function setAddressLine(string $addressLine): static
    {
        $this->addressLine = $addressLine;

        return $this;
    }

    /**
     * @return Collection<int, ClientProduct>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(ClientProduct $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setClient($this);
        }

        return $this;
    }

    public function removeProduct(ClientProduct $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getClient() === $this) {
                $product->setClient(null);
            }
        }

        return $this;
    }

    public function getMonthlyAmount(): ?int
    {
        return $this->monthlyAmount;
    }

    public function setMonthlyAmount(int $monthlyAmount): static
    {
        $this->monthlyAmount = $monthlyAmount;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): static
    {
        $this->birthDate = $birthDate;

        return $this;
    }
}
