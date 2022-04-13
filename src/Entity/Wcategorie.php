<?php

namespace App\Entity;

use App\Repository\WcategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WcategorieRepository::class)
 */
class Wcategorie
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
     * @ORM\OneToMany(targetEntity=Warticle::class, mappedBy="Wcategorie")
     */
    private $warticles;

    public function __construct()
    {
        $this->warticles = new ArrayCollection();
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
     * @return Collection<int, Warticle>
     */
    public function getWarticles(): Collection
    {
        return $this->warticles;
    }

    public function addWarticle(Warticle $warticle): self
    {
        if (!$this->warticles->contains($warticle)) {
            $this->warticles[] = $warticle;
            $warticle->setWcategorie($this);
        }

        return $this;
    }

    public function removeWarticle(Warticle $warticle): self
    {
        if ($this->warticles->removeElement($warticle)) {
            // set the owning side to null (unless already changed)
            if ($warticle->getWcategorie() === $this) {
                $warticle->setWcategorie(null);
            }
        }

        return $this;
    }

    
    public function __toString()
    {
        return $this->nom;
    }
}
