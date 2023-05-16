<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SaveursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaveursRepository::class)]
#[ApiResource]
class Saveurs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\ManyToMany(targetEntity: Bieres::class, mappedBy: 'saveurs')]
    private Collection $bieres;

    public function __construct()
    {
        $this->bieres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Bieres>
     */
    public function getBieres(): Collection
    {
        return $this->bieres;
    }

    public function addBiere(Bieres $biere): self
    {
        if (!$this->bieres->contains($biere)) {
            $this->bieres->add($biere);
            $biere->addSaveur($this);
        }

        return $this;
    }

    public function removeBiere(Bieres $biere): self
    {
        if ($this->bieres->removeElement($biere)) {
            $biere->removeSaveur($this);
        }

        return $this;
    }
}
