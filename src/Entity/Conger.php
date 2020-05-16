<?php

namespace App\Entity;

use App\Repository\CongerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CongerRepository::class)
 */
class Conger
{


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $debutConger;


    /**
     * @ORM\Column(type="datetime" ,nullable=true)
     */
    private $finConger;

    /**
     *
     * @ORM\Column(name="nbjours", type="integer")
     */
    private $nbjours ;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeConger", inversedBy="conger")
     */
    private $typeConger;

    /**
     *
     * @ORM\Column(name="cause", type="text",nullable=true)
     */
    private $cause ;

    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="string", length=255)
     */
    private $fichier;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userdemande")
     */
    private $demandeur;


    /**
     * @ORM\Column(name="repundu", type="boolean")
     */
    private  $repundu;


    public function getperiode()
    {

        $dub=$this->getDebutConger();
        $fin= $this->getFinConger();
        $now = new \DateTime('now');
        return $dub->diff($this->finConger)->format("%a jours");

    }
    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    public function getDebutConger(): ?\DateTimeInterface
    {
        return $this->debutConger;
    }

    public function setDebutConger(?\DateTimeInterface $debutConger): self
    {
        $this->debutConger = $debutConger;

        return $this;
    }

    public function getFinConger(): ?\DateTimeInterface
    {
        return $this->finConger;
    }

    public function setFinConger(?\DateTimeInterface $finConger): self
    {
        $this->finConger = $finConger;

        return $this;
    }

    public function getNbjours(): ?int
    {
        return $this->nbjours;
    }

    public function setNbjours(int $nbjours): self
    {
        $this->nbjours = $nbjours;

        return $this;
    }

    public function getCause(): ?string
    {
        return $this->cause;
    }

    public function setCause(?string $cause): self
    {
        $this->cause = $cause;

        return $this;
    }

    public function getFichier(): ?string
    {
        return $this->fichier;
    }

    public function setFichier(string $fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function getRepundu(): ?bool
    {
        return $this->repundu;
    }

    public function setRepundu(bool $repundu): self
    {
        $this->repundu = $repundu;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTypeConger()
    {
        return $this->typeConger;
    }

    public function setTypeConger(?TypeConger $typeConger): self
    {
        $this->typeConger = $typeConger;

        return $this;
    }

    public function getDemandeur(): ?User
    {
        return $this->demandeur;
    }

    public function setDemandeur(?User $demandeur): self
    {
        $this->demandeur = $demandeur;

        return $this;
    }










}
