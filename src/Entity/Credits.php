<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CreditsRepository")
 */
class Credits
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $creditMontant;

    /**
     * @ORM\Column(type="integer")
     */
    private $creditDuree;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patrimoines", inversedBy="credits", cascade={"persist"})
     */
    private $patrimoines;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreditMontant(): ?int
    {
        return $this->creditMontant;
    }

    public function setCreditMontant(int $creditMontant): self
    {
        $this->creditMontant = $creditMontant;

        return $this;
    }

    public function getCreditDuree(): ?int
    {
        return $this->creditDuree;
    }

    public function setCreditDuree(int $creditDuree): self
    {
        $this->creditDuree = $creditDuree;

        return $this;
    }

    public function getPatrimoines(): ?Patrimoines
    {
        return $this->patrimoines;
    }

    public function setPatrimoines(?Patrimoines $patrimoines): self
    {
        $this->patrimoines = $patrimoines;

        return $this;
    }
}
