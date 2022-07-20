<?php

declare(strict_types=1);

interface AuthInterface
{
    public function auth(array $user, string $password): bool;
}
