<?php

namespace App\Entity;

use App\Repository\DcategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DcategorieRepository::class)
 */
class Dcategorie
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
     * @ORM\OneToMany(targetEntity=Dproduit::class, mappedBy="Dcategories")
     */
    private $dproduits;

    public function __construct()
    {
        $this->dproduits = new ArrayCollection();
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
     * @return Collection<int, Dproduit>
     */
    public function getDproduits(): Collection
    {
        return $this->dproduits;
    }

    public function addDproduit(Dproduit $dproduit): self
    {
        if (!$this->dproduits->contains($dproduit)) {
            $this->dproduits[] = $dproduit;
            $dproduit->setDcategories($this);
        }

        return $this;
    }

    public function removeDproduit(Dproduit $dproduit): self
    {
        if ($this->dproduits->removeElement($dproduit)) {
            // set the owning side to null (unless already changed)
            if ($dproduit->getDcategories() === $this) {
                $dproduit->setDcategories(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
