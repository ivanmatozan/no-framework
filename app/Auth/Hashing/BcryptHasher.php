<?php

namespace App\Auth\Hashing;

class BcryptHasher implements HasherInterface
{
    /**
     * @var array
     */
    protected $options;

    /**
     * BcryptHasher constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * @inheritDoc
     */
    public function create(string $password): string
    {
        $hash = password_hash($password, PASSWORD_BCRYPT, $this->options);

        if (!$hash) {
            throw new \RuntimeException('Bcrypt not supported.');
        }

        return $hash;
    }

    /**
     * @inheritDoc
     */
    public function check(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

    /**
     * @inheritDoc
     */
    public function needsRehash(string $hash): bool
    {
        return password_needs_rehash($hash, PASSWORD_BCRYPT, $this->options);
    }
}
