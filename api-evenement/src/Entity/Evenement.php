<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbParticipant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userEvenements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisateur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="participations")
     */
    private $participants;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="invitations")
     */
    private $userInvites;

    /**
     * @ORM\Column(type="boolean")
     */
    private $privatisation;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->userInvites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNbParticipant(): ?int
    {
        return $this->nbParticipant;
    }

    public function setNbParticipant(int $nbParticipant): self
    {
        $this->nbParticipant = $nbParticipant;

        return $this;
    }

    public function getOrganisateur(): ?User
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?User $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(User $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->addParticipation($this);
        }

        return $this;
    }

    public function removeParticipant(User $participant): self
    {
        if ($this->participants->contains($participant)) {
            $this->participants->removeElement($participant);
            $participant->removeParticipation($this);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUserInvites(): Collection
    {
        return $this->userInvites;
    }

    public function addUserInvite(User $userInvite): self
    {
        if (!$this->userInvites->contains($userInvite)) {
            $this->userInvites[] = $userInvite;
            $userInvite->addInvitation($this);
        }

        return $this;
    }

    public function removeUserInvite(User $userInvite): self
    {
        if ($this->userInvites->contains($userInvite)) {
            $this->userInvites->removeElement($userInvite);
            $userInvite->removeInvitation($this);
        }

        return $this;
    }

    public function getPrivatisation(): ?bool
    {
        return $this->privatisation;
    }

    public function setPrivatisation(bool $privatisation): self
    {
        $this->privatisation = $privatisation;

        return $this;
    }
    
}
