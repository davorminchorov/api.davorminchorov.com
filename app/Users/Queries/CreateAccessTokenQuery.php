<?php

namespace DavorMinchorov\Users\Queries;

use DavorMinchorov\Users\Models\User;

class CreateAccessTokenQuery
{
    /**
     * Creates a specific access token with a specific name for a specific user.
     *
     * @param User $user
     * @param string $tokenName
     *
     * @return string
     */
    public function __invoke(User $user, string $tokenName): string
    {
        return $user->createToken($tokenName)->plainTextToken;
    }
}
