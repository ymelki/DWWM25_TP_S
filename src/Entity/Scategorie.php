<?php

namespace App\Entity;

use App\Repository\ScategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ScategorieRepository::class)
 */
class Scategorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Sproduit::class, mappedBy="categories", orphanRemoval=true)
     */
    private $sproduits;

    public function __construct()
    {
        $this->sproduits = new ArrayCollection();
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

    /**
     * @return Collection<int, Sproduit>
     */
    public function getSproduits(): Collection
    {
        return $this->sproduits;
    }

    public function addSproduit(Sproduit $sproduit): self
    {
        if (!$this->sproduits->contains($sproduit)) {
            $this->sproduits[] = $sproduit;
            $sproduit->setCategories($this);
        }

        return $this;
    }

    public function removeSproduit(Sproduit $sproduit): self
    {
        if ($this->sproduits->removeElement($sproduit)) {
            // set the owning side to null (unless already changed)
            if ($sproduit->getCategories() === $this) {
                $sproduit->setCategories(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
