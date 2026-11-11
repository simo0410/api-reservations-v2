<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ArtistRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
#[ORM\Table(name: 'artists')]
#[ApiResource(
    normalizationContext: ['groups' => ['artist:read']],
    denormalizationContext: ['groups' => ['artist:write']],  
    paginationEnabled: false
)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['artist:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    #[Groups(['artist:read', 'artist:write'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 60)]
    #[Groups(['artist:read', 'artist:write'])]
    private ?string $lastname = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function __toString(): string
    {
        return "{$this->firstname} {$this->lastname}";
    }


}
