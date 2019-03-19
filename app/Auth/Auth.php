<?php

namespace App\Auth;

use Doctrine\ORM\EntityManager;
use App\Auth\Hashing\HasherInterface;
use App\Models\User;
use App\Session\SessionInterface;

class Auth
{
    protected const USER_ID = 'user_id';

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
     * @var User
     */
    protected $user;

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
        $this->init();
    }

    protected function init(): void
    {
        if ($this->session->exists(self::USER_ID)) {
            $user = $this->getById($this->session->get(self::USER_ID));
            $user ? $this->user = $user : $this->logout();
        }
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

        if ($this->needsRehash($user)) {
            $this->rehashPassword($user, $password);
        }

        $this->session->set(self::USER_ID, $user->getId());
        $this->user = $user;

        return true;
    }

    public function logout()
    {
        //
    }

    /**
     * @return bool
     */
    public function check(): bool
    {
        return isset($this->user);
    }

    /**
     * @return User
     */
    public function user(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @param string $password
     * @return bool
     */
    protected function hasValidCredentials(User $user, string $password): bool
    {
        return $this->hash->check($password, $user->getPassword());
    }

    /**
     * @param User $user
     * @return bool
     */
    protected function needsRehash(User $user): bool
    {
        return $this->hash->needsRehash($user->getPassword());
    }

    /**
     * @param User $user
     * @param string $password
     */
    protected function rehashPassword(User $user, string $password): void
    {
        $user->setPassword($this->hash->create($password));

        try {
            $this->em->flush();
        } catch (\Doctrine\ORM\ORMException $e) {
        }
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
     * @param int $id
     * @return User|null
     */
    protected function getById(int $id): ?User
    {
        return $this->em->getRepository(User::class)->find($id);
    }
}
