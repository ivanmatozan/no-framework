<?php

namespace App\Auth\Hashing;

interface HasherInterface
{
    /**
     * @param string $password
     * @return string
     */
    public function create(string $password): string;

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function check(string $password, string $hash): bool;

    /**
     * @param string $hash
     * @return bool
     */
    public function needsRehash(string $hash): bool;
}
