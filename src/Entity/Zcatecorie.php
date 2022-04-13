<?php

namespace App\Entity;

use App\Repository\ZcatecorieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ZcatecorieRepository::class)
 */
class Zcatecorie
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
     * @ORM\ManyToOne(targetEntity=Wproduit::class, inversedBy="Zcatecories")
     */
    private $wproduit;

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

    public function getWproduit(): ?Wproduit
    {
        return $this->wproduit;
    }

    public function setWproduit(?Wproduit $wproduit): self
    {
        $this->wproduit = $wproduit;

        return $this;
    }
}
