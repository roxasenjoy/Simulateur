<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InvestissementsRepository")
 */
class Investissements
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=50, minMessage="Ceci est un test de validation")
     */
    private $investMontant;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero(message="Votre valeur doit être positive.")
     */
    private $investDuree;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero(message="Votre valeur doit être positive.")
     */
    private $investRente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patrimoines", inversedBy="investissements", cascade={"persist"})
     *
     */
    private $patrimoines;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero(message="Votre valeur doit être positive.")
     */
    private $investAchat;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvestMontant(): ?int
    {
        return $this->investMontant;
    }

    public function setInvestMontant(int $investMontant): self
    {
        $this->investMontant = $investMontant;

        return $this;
    }

    public function getInvestDuree(): ?int
    {
        return $this->investDuree;
    }

    public function setInvestDuree(int $investDuree): self
    {
        $this->investDuree = $investDuree;

        return $this;
    }

    public function getInvestRente(): ?int
    {
        return $this->investRente;
    }

    public function setInvestRente(int $investRente): self
    {
        $this->investRente = $investRente;

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

    public function getInvestAchat(): ?int
    {
        return $this->investAchat;
    }

    public function setInvestAchat(int $investAchat): self
    {
        $this->investAchat = $investAchat;

        return $this;
    }

}
