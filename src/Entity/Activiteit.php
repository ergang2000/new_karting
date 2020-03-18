<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActiviteitRepository")
 */
class Activiteit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="vul een datum in")
     */
    private $datum;

    /**
     * @ORM\Column(type="time")
     * @Assert\NotBlank(message="vul een tijd in")
     */
    private $tijd;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Soortactiviteit", inversedBy="activiteiten")
     * @ORM\JoinColumn(name="soort_id",referencedColumnName="id")
     */
    private $soort;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="activiteiten")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getTijd(): ?\DateTimeInterface
    {
        return $this->tijd;
    }

    public function setTijd(\DateTimeInterface $tijd): self
    {
        $this->tijd = $tijd;

        return $this;
    }

    public function getSoort(): ?Soortactiviteit
    {
        return $this->soort;
    }

    public function setSoort(?Soortactiviteit $soort): self
    {
        $this->soort = $soort;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }
}
