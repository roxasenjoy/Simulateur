<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObjectifsRepository")
 */
class Objectifs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(groups={"objectifs"})
     */
    private $object1;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(groups={"objectifs"})
     */
    private $object2;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(groups={"objectifs"})
     */
    private $object3;

    /**
     * @var Clients
     *
     * @ORM\OneToOne(targetEntity=Clients::class, cascade={"persist"}, inversedBy="objectifs")
     * @ORM\JoinColumn(name="clients_id", referencedColumnName="id", onDelete="SET NULL")
     * @Assert\NotBlank(groups={"clients"})
     */
    private $clients;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObject1(): ?string
    {
        return $this->object1;
    }

    public function setObject1(string $object1): self
    {
        $this->object1 = $object1;

        return $this;
    }

    public function getObject2(): ?string
    {
        return $this->object2;
    }

    public function setObject2(string $object2): self
    {
        $this->object2 = $object2;

        return $this;
    }

    public function getObject3(): ?string
    {
        return $this->object3;
    }

    public function setObject3(string $object3): self
    {
        $this->object3 = $object3;

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
