<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BieresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BieresRepository::class)]
#[ApiResource]
class Bieres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $nbDegres = null;

    #[ORM\Column]
    private ?bool $saison = null;

    #[ORM\ManyToOne(inversedBy: 'bieres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Brasseries $brasserieId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getNbDegres(): ?float
    {
        return $this->nbDegres;
    }

    public function setNbDegres(float $nbDegres): self
    {
        $this->nbDegres = $nbDegres;

        return $this;
    }

    public function isSaison(): ?bool
    {
        return $this->saison;
    }

    public function setSaison(bool $saison): self
    {
        $this->saison = $saison;

        return $this;
    }

    public function getBrasserieId(): ?Brasseries
    {
        return $this->brasserieId;
    }

    public function setBrasserieId(?Brasseries $brasserieId): self
    {
        $this->brasserieId = $brasserieId;

        return $this;
    }
}
