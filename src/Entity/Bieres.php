<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BieresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BieresRepository::class)]
#[ApiResource(formats: 'json')]
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

    #[ORM\ManyToOne(inversedBy: 'bieres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Couleurs $couleur = null;

    #[ORM\ManyToMany(targetEntity: Saveurs::class, inversedBy: 'bieres')]
    private Collection $saveurs;

    #[ORM\Column(length: 255)]
    private ?string $amertume = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $asset = null;

    public function __construct()
    {
        $this->saveurs = new ArrayCollection();
    }

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

    public function getCouleur(): ?Couleurs
    {
        return $this->couleur;
    }

    public function setCouleur(?Couleurs $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return Collection<int, Saveurs>
     */
    public function getSaveurs(): Collection
    {
        return $this->saveurs;
    }

    public function addSaveur(Saveurs $saveur): self
    {
        if (!$this->saveurs->contains($saveur)) {
            $this->saveurs->add($saveur);
        }

        return $this;
    }

    public function removeSaveur(Saveurs $saveur): self
    {
        $this->saveurs->removeElement($saveur);

        return $this;
    }

    public function getAmertume(): ?string
    {
        return $this->amertume;
    }

    public function setAmertume(string $amertume): self
    {
        $this->amertume = $amertume;

        return $this;
    }

    public function getAsset(): ?string
    {
        return $this->asset;
    }

    public function setAsset(?string $asset): self
    {
        $this->asset = $asset;

        return $this;
    }
}
