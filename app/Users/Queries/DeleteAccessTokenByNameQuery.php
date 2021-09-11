<?php

namespace DavorMinchorov\Users\Queries;

use DavorMinchorov\Users\Models\User;

class DeleteAccessTokenByNameQuery
{
    /**
     * Revokes a specific access token by name for a specific user.
     *
     * @param string $tokenName
     * @param User|null $user
     *
     * @return int|null
     */
    public function __invoke(string $tokenName, ?User $user): int|null
    {
        return $user?->tokens()->where('name', $tokenName)->delete();
    }
}
