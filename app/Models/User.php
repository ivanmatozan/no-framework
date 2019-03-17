<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User extends Base
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
}
