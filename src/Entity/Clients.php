<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientsRepository")
 */
class Clients
{
    // Taille du numéro de validation
    const CODE_LENGTH = 6;


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(groups={"clients"}, message="Votre valeur n'est pas valide.")
     * @Assert\Length(max=100, maxMessage="Vous avez atteint la taille maximum.")
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre nom est incorrecte.",
     *     groups={"clients"}
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(groups={"clients"}, message="Votre valeur n'est pas valide.")
     * @Assert\Length(max=100, maxMessage="Vous avez atteint la taille maximum.", groups={"clients"})
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Votre prénom est incorrecte.",
     *     groups={"clients"}
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(groups={"clients"}, message="Votre valeur n'est pas valide.")
     * @Assert\Email(
     *     message = "Votre email  '{{ value }}' n'est pas valide."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(groups={"clients"}, message="Votre valeur n'est pas valide.")
     */
    private $codePostal;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(groups={"clients"}, message="Votre valeur n'est pas valide.")
     * @Assert\Length(max=15, maxMessage="Votre numéro de téléphone est incorrecte.", groups={"clients"})
     */
    private $telephone;


    /**
     * @ORM\Column(type="boolean")
     */
    private $verificationCode;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(groups={"clients"})
     *
     */
    private $telephonePays;


    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank(groups={"clients"})
     */
    private $condGenerales;

    /**
     * @var ArrayCollection|Collection
     * @Assert\NotBlank(groups={"situations"})
     * @ORM\OneToOne(targetEntity=Situations::class, mappedBy="clients", cascade={"persist"})
     * @Assert\Valid
     */
    private $situations;

    /**
     * @var ArrayCollection|Collection
     * @Assert\NotBlank(groups={"patrimoines"})
     * @ORM\OneToOne(targetEntity=Patrimoines::class, mappedBy="clients", cascade={"persist"})
     * @Assert\Valid
     */
    private $patrimoines;

    /**
     * @var ArrayCollection|Collection
     * @Assert\NotBlank(groups={"epargnes"})
     * @ORM\OneToOne(targetEntity=Epargnes::class, mappedBy="clients", cascade={"persist"})
     * @Assert\Valid
     */
    private $epargnes;

    /**
     * @var ArrayCollection|Collection
     * @Assert\NotBlank(groups={"objectifs"})
     * @ORM\OneToOne(targetEntity=Objectifs::class, mappedBy="clients", cascade={"persist"})
     * @Assert\Valid
     */
    private $objectifs;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCondGenerales(): ?bool
    {
        return (bool) $this->condGenerales;
    }

    public function setCondGenerales(bool $condGenerales): self
    {
        $this->condGenerales = $condGenerales;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSituations():?Situations
    {
        return $this->situations;
    }

    public function setSituations(Situations $situations) :self
    {
        $situations->setClients($this);
        $this->situations = $situations;
        return $this;
    }


    /**
     * @return Collection
     */
    public function getPatrimoines():?Patrimoines
    {
        return $this->patrimoines;
    }

    public function setPatrimoines(Patrimoines $patrimoines) :self
    {
        $patrimoines->setClients($this);
        $this->patrimoines = $patrimoines;
        return $this;
    }
    /**
     * @return Collection
     */
    public function getEpargnes():?Epargnes
    {
        return $this->epargnes;
    }

    public function setEpargnes(Epargnes $epargnes) :self
    {
        $epargnes->setClients($this);
        $this->epargnes = $epargnes;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getObjectifs():?Objectifs
    {
        return $this->objectifs;
    }

    public function setObjectifs(Objectifs $objectifs) :self
    {
        $objectifs->setClients($this);
        $this->objectifs = $objectifs;
        return $this;
    }

    public function getVerificationCode(): ?bool
    {
        return $this->verificationCode;
    }

    public function setVerificationCode(bool $verificationCode): self
    {
        $this->verificationCode = $verificationCode;

        return $this;
    }

    public function getTelephonePays(): ?string
    {
        return $this->telephonePays;
    }

    public function setTelephonePays(string $telephonePays): self
    {
        $this->telephonePays = $telephonePays;

        return $this;
    }

}
