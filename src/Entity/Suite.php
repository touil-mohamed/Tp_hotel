<?php

namespace App\Entity;

use App\Repository\SuiteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuiteRepository::class)]
class Suite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private  ?array $galeryImage = [];

    #[ORM\ManyToOne(inversedBy: 'suites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?etablissement $etablissementId = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getGaleryImage(): ?array
    {
        return $this->galeryImage;
    }

    public function setGaleryImage(array $galeryImage): self
    {
        $this->galeryImage[]=$galeryImage;
        return $this;
    }

    public function getEtablissementId(): ?etablissement
    {
        return $this->etablissementId;
    }

    public function setEtablissementId(?etablissement $etablissementId): self
    {
        $this->etablissementId = $etablissementId;

        return $this;
    }
}
