<?php

namespace App\Entity;

use App\Repository\TypeCongerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeCongerRepository::class)
 */
class TypeConger
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255, nullable=true)
     */
    protected $titre;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Conger", mappedBy="typeConger")
     */
    private $conger;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConger(): ?Conger
    {
        return $this->conger;
    }

    public function setConger(?Conger $conger): self
    {
        $this->conger = $conger;

        // set (or unset) the owning side of the relation if necessary
        $newTypeConger = null === $conger ? null : $this;
        if ($conger->getTypeConger() !== $newTypeConger) {
            $conger->setTypeConger($newTypeConger);
        }

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }



}
