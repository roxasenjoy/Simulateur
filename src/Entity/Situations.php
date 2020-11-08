<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass="App\Repository\SituationsRepository")
 */
class Situations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(groups={"situations"})
     */
    private $famille;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(groups={"situations"})
     * @Assert\Range(
     *      min = 1900,
     *      minMessage = "Votre valeur doit être supérieure à 1900",
     *     groups={"situations"}
     * )
     *
     */
    private $naissance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero(message="Votre valeur doit être positive.", groups={"situations"})
     */
    private $enfant;

    /**
     * @ORM\Column(type="decimal", type="integer")
     * @Assert\PositiveOrZero(message="Votre valeur doit être positive.", groups={"situations"})
     */
    private $enfantFiscal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero(message="Votre valeur doit être positive.", groups={"situations"})
     */
    private $pension;

    /************************
     *      RELATION
     *************************/

    /**
     * @var Clients|null
     *
     * @ORM\OneToOne(targetEntity=Clients::class, cascade={"persist"}, inversedBy="situations")
     * @ORM\JoinColumn(name="clients_id", referencedColumnName="id", onDelete="SET NULL")
     * @Assert\NotBlank(groups={"clients"})
     */
    private $clients;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFamille(): ?string
    {
        return $this->famille;
    }

    public function setFamille(string $famille): self
    {
        $this->famille = $famille;

        return $this;
    }

    public function getNaissance(): ?int
    {
        return $this->naissance;
    }

    public function setNaissance(int $naissance): self
    {
        $this->naissance = $naissance;

        return $this;
    }

    public function getEnfant(): ?int
    {
        return $this->enfant;
    }

    public function setEnfant(int $enfant): self
    {
        $this->enfant = $enfant;

        return $this;
    }

    public function getEnfantFiscal(): ?int
    {
        return $this->enfantFiscal;
    }

    public function setEnfantFiscal(?int $enfantFiscal): self
    {
        $this->enfantFiscal = $enfantFiscal;

        return $this;
    }

    public function getPension(): ?int
    {
        return $this->pension;
    }

    public function setPension(?int $pension): self
    {
        $this->pension = $pension;

        return $this;
    }

    /**
     * @return Clients|null
     */
    public function getClients(): ?Clients
    {
        return $this->clients;
    }

    /**
     * @param Clients|null $clients
     */
    public function setClients(?Clients $clients): void
    {
        $this->clients = $clients;
    }
}
