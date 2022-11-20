<?php

namespace App\Entity;

use App\Repository\LienRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LienRepository::class)
 */
class Lien
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", name="idMateriel", nullable=true)
     */
    private $idMateriel;

    /**
     * @ORM\ManyToOne(targetEntity=Materiel::class, inversedBy="liens")
     * @ORM\JoinColumn(name="idMateriel", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $materiels;

    /**
     * @ORM\Column(type="integer", name="idCLient", nullable=true)
     */
    private $idClient;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="liens")
     * @ORM\JoinColumn(name="idCLient", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $clients;

    /**
     * @Assert\PositiveOrZero
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantite;

    /**
     * @Assert\PositiveOrZero
     * @Assert\Type(type="float", message="format invalide")
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixTotal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMateriel(): ?int
    {
        return $this->idMateriel;
    }

    public function setIdMateriel(?int $idMateriel): self
    {
        $this->idMateriel = $idMateriel;

        return $this;
    }

    public function getMateriels(): ?Materiel
    {
        return $this->materiels;
    }

    public function setMateriels(?Materiel $materiels): self
    {
        $this->materiels = $materiels;

        return $this;
    }

    public function getIdClient(): ?int
    {
        return $this->idClient;
    }

    public function setIdClient(?int $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }

    public function getClients(): ?Client
    {
        return $this->clients;
    }

    public function setClients(?Client $clients): self
    {
        $this->clients = $clients;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixTotal(): ?float
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(?float $prixTotal): self
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }
}
