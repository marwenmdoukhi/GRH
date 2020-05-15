<?php
// src/Entity/User.php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    protected $lastname;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="datenaissance", type="date", nullable=true)
     */
    protected $datenaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    protected $photo;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    protected $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255, nullable=false)
     */
    protected $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="codepostale", type="integer", nullable=true)
     */
    protected $codepostale;

    /**
     * @var string
     *
     * @ORM\Column(name="nbConger", type="integer", nullable=true)
     */
    protected $nbConger;


    /**
     * @ORM\ManyToOne( targetEntity="App\Entity\Pays", inversedBy="userpays")
     * @ORM\JoinColumn(nullable=true)
     */
    private $pays;



    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Conger", mappedBy="demandeur")
     */
    private $userdemande;



    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $createdAt;

    public function __construct() {
        parent::__construct();
        $this->setPhoto('inconnu.png');
        $this->createdAt= new \DateTime();
        $this->nbConger="21";

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getDatenaissance(): ?\DateTimeInterface
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(?\DateTimeInterface $datenaissance): self
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCodepostale(): ?int
    {
        return $this->codepostale;
    }

    public function setCodepostale(?int $codepostale): self
    {
        $this->codepostale = $codepostale;

        return $this;
    }

    public function getNbConger(): ?int
    {
        return $this->nbConger;
    }

    public function setNbConger(?int $nbConger): self
    {
        $this->nbConger = $nbConger;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getUserdemande(): ?Conger
    {
        return $this->userdemande;
    }

    public function setUserdemande(?Conger $userdemande): self
    {
        $this->userdemande = $userdemande;

        // set (or unset) the owning side of the relation if necessary
        $newDemandeur = null === $userdemande ? null : $this;
        if ($userdemande->getDemandeur() !== $newDemandeur) {
            $userdemande->setDemandeur($newDemandeur);
        }

        return $this;
    }






}