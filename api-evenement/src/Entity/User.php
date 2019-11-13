<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Evenement", mappedBy="organisateur", orphanRemoval=true)
     */
    private $userEvenements;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Evenement", inversedBy="participants")
     * @ORM\JoinTable(name="user_participants_evenement")
     */
    private $participations;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Evenement", inversedBy="userInvites")
     * @ORM\JoinTable(name="user_invites_evenement")
     */
    private $invitations;

    public function __construct()
    {
        $this->userEvenements = new ArrayCollection();
        $this->participations = new ArrayCollection();
        $this->invitations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getUserEvenements(): Collection
    {
        return $this->userEvenements;
    }

    public function addUserEvenement(Evenement $userEvenement): self
    {
        if (!$this->userEvenements->contains($userEvenement)) {
            $this->userEvenements[] = $userEvenement;
            $userEvenement->setOrganisateur($this);
        }

        return $this;
    }

    public function removeUserEvenement(Evenement $userEvenement): self
    {
        if ($this->userEvenements->contains($userEvenement)) {
            $this->userEvenements->removeElement($userEvenement);
            // set the owning side to null (unless already changed)
            if ($userEvenement->getOrganisateur() === $this) {
                $userEvenement->setOrganisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Evenement $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
        }

        return $this;
    }

    public function removeParticipation(Evenement $participation): self
    {
        if ($this->participations->contains($participation)) {
            $this->participations->removeElement($participation);
        }

        return $this;
    }

    /**
     * @return Collection|Evenement[]
     */
    public function getInvitations(): Collection
    {
        return $this->invitations;
    }

    public function addInvitation(Evenement $invitation): self
    {
        if (!$this->invitations->contains($invitation)) {
            $this->invitations[] = $invitation;
        }

        return $this;
    }

    public function removeInvitation(Evenement $invitation): self
    {
        if ($this->invitations->contains($invitation)) {
            $this->invitations->removeElement($invitation);
        }

        return $this;
    }
}
