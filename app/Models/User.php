<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column()
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column()
     *
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column()
     *
     * @var string
     */
    protected $password;

    /**
     * @ORM\Column(name="remember_token")
     *
     * @var string|null
     */
    protected $rememberToken;

    /**
     * @ORM\Column(name="remember_identifier")
     *
     * @var string|null
     */
    protected $rememberIdentifier;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getRememberToken(): ?string
    {
        return $this->rememberToken;
    }

    /**
     * @param string|null $rememberToken
     */
    public function setRememberToken(?string $rememberToken): void
    {
        $this->rememberToken = $rememberToken;
    }

    /**
     * @return string|null
     */
    public function getRememberIdentifier(): ?string
    {
        return $this->rememberIdentifier;
    }

    /**
     * @param string|null $rememberIdentifier
     */
    public function setRememberIdentifier(?string $rememberIdentifier): void
    {
        $this->rememberIdentifier = $rememberIdentifier;
    }
}
