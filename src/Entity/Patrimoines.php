<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PatrimoinesRepository")
 */
class Patrimoines
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(groups={"patrimoines"})
     */
    private $bail;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero(message="Votre valeur doit être positive.", groups={"patrimoines"})
     */
    private $proprioCredit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero(message="Votre valeur doit être positive.", groups={"patrimoines"})
     */
    private $proprioDuree;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\PositiveOrZero(message="Votre valeur doit être positive.", groups={"patrimoines"})
     */
    private $locaLoyer;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(groups={"patrimoines"})
     * @Assert\PositiveOrZero(message="Votre valeur doit être positive.", groups={"patrimoines"})
     */
    private $revenuFoyer;

    /**
     * @var Clients
     *
     * @ORM\OneToOne(targetEntity=Clients::class, cascade={"persist"}, inversedBy="patrimoines")
     * @ORM\JoinColumn(name="clients_id", referencedColumnName="id", onDelete="SET NULL")
     * @Assert\NotBlank(groups={"clients"})
     */
    private $clients;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Investissements", mappedBy="patrimoines", cascade={"persist"})
     * @ORM\JoinColumn(name="patrimoines_id", referencedColumnName="id", nullable=false)
     */
    private $investissements;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Credits", mappedBy="patrimoines", cascade={"persist"})
     * @ORM\JoinColumn(name="patrimoines_id", referencedColumnName="id", nullable=false)
     */
    private $credits;




    public function __construct()
    {
        $this->investissements = new ArrayCollection();
        $this->credits = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBail(): ?string
    {
        return $this->bail;
    }

    public function setBail(string $bail): self
    {
        $this->bail = $bail;

        return $this;
    }

    public function getProprioCredit(): ?int
    {
        return $this->proprioCredit;
    }

    public function setProprioCredit(?int $proprioCredit): self
    {
        $this->proprioCredit = $proprioCredit;

        return $this;
    }

    public function getProprioDuree(): ?int
    {
        return $this->proprioDuree;
    }

    public function setProprioDuree(?int $proprioDuree): self
    {
        $this->proprioDuree = $proprioDuree;

        return $this;
    }

    public function getLocaLoyer(): ?int
    {
        return $this->locaLoyer;
    }

    public function setLocaLoyer(?int $locaLoyer): self
    {
        $this->locaLoyer = $locaLoyer;

        return $this;
    }

    public function getRevenuFoyer(): ?int
    {
        return $this->revenuFoyer;
    }

    public function setRevenuFoyer(int $revenuFoyer): self
    {
        $this->revenuFoyer = $revenuFoyer;

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

    /**
     * @return Collection|Investissements[]
     */
    public function getInvestissements(): Collection
    {
        return $this->investissements;
    }

    public function addInvestissement(Investissements $investissement): self
    {
        if (!$this->investissements->contains($investissement)) {
            $this->investissements[] = $investissement;
            $investissement->setPatrimoines($this);
        }

        return $this;
    }

    public function removeInvestissement(Investissements $investissement): self
    {
        if ($this->investissements->contains($investissement)) {
            $this->investissements->removeElement($investissement);
            // set the owning side to null (unless already changed)
            if ($investissement->getPatrimoines() === $this) {
                $investissement->setPatrimoines(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Credits[]
     */
    public function getCredits(): Collection
    {
        return $this->credits;
    }

    public function addCredit(Credits $credit): self
    {
        if (!$this->credits->contains($credit)) {
            $this->credits[] = $credit;
            $credit->setPatrimoines($this);
        }

        return $this;
    }

    public function removeCredit(Credits $credit): self
    {
        if ($this->credits->contains($credit)) {
            $this->credits->removeElement($credit);
            // set the owning side to null (unless already changed)
            if ($credit->getPatrimoines() === $this) {
                $credit->setPatrimoines(null);
            }
        }

        return $this;
    }
}