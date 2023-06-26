<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Entity\Interfaces\ContainsDateRange;
use App\Repository\RentalRepository;
use App\Validator as CustomAssert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentalRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'rentals')]
#[ApiResource(operations: [
    new Get(),
    new GetCollection(),
    new Post(),
])]
final class Rental implements ContainsDateRange
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    #[ApiProperty(writable: false)]
    private ?int $price = null;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: Bicycle::class, inversedBy: 'rentals')]
        private Bicycle $bike,

        #[CustomAssert\IsDateRange]
        #[CustomAssert\IsRentalAvailable]
        #[ORM\Column(type: 'datetime')]
        private \DateTime $dateStart,

        #[ORM\Column(type: 'datetime')]
        private \DateTime $dateEnd,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBike(): Bicycle
    {
        return $this->bike;
    }

    public function setBike(Bicycle $bike): void
    {
        $this->bike = $bike;
    }

    public function getDateStart(): \DateTime
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTime $dateStart): void
    {
        $this->dateStart = $dateStart;
    }

    public function getDateEnd(): \DateTime
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTime $dateEnd): void
    {
        $this->dateEnd = $dateEnd;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }
}
