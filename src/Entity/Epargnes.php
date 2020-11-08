<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\EpargnesRepository")
 */
class Epargnes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(groups={"epargnes"})
     * @Assert\PositiveOrZero(message="Votre valeur doit être positive.", groups={"epargnes"})
     */
    private $montant;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero(message="Votre valeur doit être positive.", groups={"epargnes"})
     */
    private $apport;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero(message="Votre valeur doit être positive.", groups={"epargnes"})
     */
    private $reductionImpot;

    /**
     * @var Clients
     *
     * @ORM\OneToOne(targetEntity=Clients::class, cascade={"persist"}, inversedBy="epargnes")
     * @ORM\JoinColumn(name="clients_id", referencedColumnName="id", onDelete="SET NULL")
     * @Assert\NotBlank(groups={"clients"})
     */
    private $clients;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getApport(): ?int
    {
        return $this->apport;
    }

    public function setApport(?int $apport): self
    {
        $this->apport = $apport;

        return $this;
    }

    public function getReductionImpot(): ?int
    {
        return $this->reductionImpot;
    }

    public function setReductionImpot(?int $reductionImpot): self
    {
        $this->reductionImpot = $reductionImpot;

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
