<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(message="vul gebruikersnaam in")
     */
    private string $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private string $password;

    /**
     * @Assert\Length(max=4096)
     * @Assert\NotBlank(message="vul wachtwoord in")
     */
    private string $plainPassword;

    /**
     * @ORM\Column(type="string", length=60, unique=false)
     * @Assert\Email(
     *    message = "The email '{{ value }}' is geen geldig email adres")
     * @Assert\NotBlank(message="vul emailadres in")
     */
    private string $email;

    /**
     * @ORM\Column(type="string", length=10)
     * @Assert\NotBlank(message="vul voorletters in")
     */
    private string $voorletters;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private string $tussenvoegsel;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(message="vul achternaam in")
     */
    private string $achternaam;

    /**
     * @ORM\Column(type="string", length=7)
     * @Assert\NotBlank(message="vul adres in")
     */
    private string $adres;

    /**
     * @ORM\Column(type="string", length=7)
     * @Assert\NotBlank(message="vul postcode in")
     */
    private string $postcode;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank(message="vul woonplaats in")
     */
    private string $woonplaats;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank(message="vul telfoonnummer in")
     */
    private string $telefoon;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword): self
    {
        $this->plainPassword = $plainPassword;

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

    public function getVoorletters(): ?string
    {
        return $this->voorletters;
    }

    public function setVoorletters(string $voorletters): self
    {
        $this->voorletters = $voorletters;

        return $this;
    }

    public function getTussenvoegsel(): ?string
    {
        return $this->tussenvoegsel;
    }

    public function setTussenvoegsel(?string $tussenvoegsel): self
    {
        $this->tussenvoegsel = $tussenvoegsel;

        return $this;
    }

    public function getAchternaam(): ?string
    {
        return $this->achternaam;
    }

    public function setAchternaam(string $achternaam): self
    {
        $this->achternaam = $achternaam;

        return $this;
    }

    public function getAdres(): ?string
    {
        return $this->adres;
    }

    public function setAdres(string $adres): self
    {
        $this->adres = $adres;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getWoonplaats(): ?string
    {
        return $this->woonplaats;
    }

    public function setWoonplaats(string $woonplaats): self
    {
        $this->woonplaats = $woonplaats;

        return $this;
    }

    public function getTelefoon(): ?string
    {
        return $this->telefoon;
    }

    public function setTelefoon(string $telefoon): self
    {
        $this->telefoon = $telefoon;

        return $this;
    }

    public function setRoles($roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /**
     * @inheritDoc
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
// see section on salt below
// $this->salt
            ) = unserialize($serialized);
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
