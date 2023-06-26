<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'bicycles')]
#[ApiResource(operations: [
    new Get(),
    new GetCollection(),
    new Post(),
])]
final class Bicycle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var ArrayCollection
     */
    #[ORM\OneToMany(mappedBy: 'bike', targetEntity: Rental::class, cascade: ['persist'])]
    #[ApiProperty(writable: false)]
    public iterable $rentals;

    public function __construct(
        #[ORM\Column(type: 'text')]
        #[Assert\Choice(['ELECTRIC', 'NORMAL', 'OLD'])]
        private string $type,

        #[ORM\Column(type: 'boolean', length: 32)]
        private bool $premium = false,
    ) {
        $this->rentals = new ArrayCollection();
    }

    public function addRental(Rental $rental): void
    {
        $rental->setBike($this);
        $this->rentals->add($rental);
    }

    public function removeRental(Rental $rental): void
    {
        $this->rentals->removeElement($rental);
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setPremium(bool $premium): void
    {
        $this->premium = $premium;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isPremium(): bool
    {
        return $this->premium;
    }
}
