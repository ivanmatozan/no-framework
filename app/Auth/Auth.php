<?php

namespace App\Auth;

use Doctrine\ORM\EntityManager;
use App\Auth\Hashing\HasherInterface;
use App\Models\User;
use App\Session\SessionInterface;

class Auth
{
    /**
     * @var EntityManager 
     */
    protected $em;

    /**
     * @var HasherInterface
     */
    protected $hash;

    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * Auth constructor.
     * @param EntityManager $em
     * @param HasherInterface $hash
     * @param SessionInterface $session
     */
    public function __construct(
        EntityManager $em,
        HasherInterface $hash,
        SessionInterface $session
    ) {
        $this->em = $em;
        $this->hash = $hash;
        $this->session = $session;
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function attempt(string $email, string $password): bool
    {
        $user = $this->getByEmail($email);

        if (null === $user || !$this->hasValidCredentials($user, $password)) {
            return false;
        }

        $this->session->set('user_id', $user->id);
        return true;
    }

    /**
     * @param string $email
     * @return User|null
     */
    protected function getByEmail(string $email): ?User
    {
        return $this->em->getRepository(User::class)->findOneBy([
            'email' => $email
        ]);
    }

    /**
     * @param User $user
     * @param string $password
     * @return bool
     */
    protected function hasValidCredentials(User $user, string $password): bool
    {
        return $this->hash->check($password, $user->password);
    }
}
