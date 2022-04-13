<?php

namespace App\Entity;

use App\Repository\WproduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WproduitRepository::class)
 */
class Wproduit
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity=Zcatecorie::class, mappedBy="wproduit")
     */
    private $Zcatecories;

    public function __construct()
    {
        $this->Zcatecories = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Zcatecorie>
     */
    public function getZcatecories(): Collection
    {
        return $this->Zcatecories;
    }

    public function addZcatecory(Zcatecorie $zcatecory): self
    {
        if (!$this->Zcatecories->contains($zcatecory)) {
            $this->Zcatecories[] = $zcatecory;
            $zcatecory->setWproduit($this);
        }

        return $this;
    }

    public function removeZcatecory(Zcatecorie $zcatecory): self
    {
        if ($this->Zcatecories->removeElement($zcatecory)) {
            // set the owning side to null (unless already changed)
            if ($zcatecory->getWproduit() === $this) {
                $zcatecory->setWproduit(null);
            }
        }

        return $this;
    }
}
