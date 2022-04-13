<?php

namespace App\Entity;

use App\Repository\DproduitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DproduitRepository::class)
 */
class Dproduit
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
     * @ORM\ManyToOne(targetEntity=Dcategorie::class, inversedBy="dproduits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Dcategories;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagefilename;

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

    public function getDcategories(): ?Dcategorie
    {
        return $this->Dcategories;
    }

    public function setDcategories(?Dcategorie $Dcategories): self
    {
        $this->Dcategories = $Dcategories;

        return $this;
    }

    public function getImagefilename(): ?string
    {
        return $this->imagefilename;
    }

    public function setImagefilename(string $imagefilename): self
    {
        $this->imagefilename = $imagefilename;

        return $this;
    }
}
