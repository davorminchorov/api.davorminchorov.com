<?php

namespace DavorMinchorov\Users\Queries;

use DavorMinchorov\Users\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

class RevokeAccessTokenByNameQuery
{
    /**
     * Revokes a specific access token by name for a specific user.
     *
     * @param User|Authenticatable $user
     * @param string $tokenName
     *
     * @return int
     */
    public function __invoke(User|Authenticatable $user, string $tokenName): int
    {
        return $user->tokens()->where('name', $tokenName)->delete();
    }
}
