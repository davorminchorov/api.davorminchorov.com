<?php

namespace DavorMinchorov\PersonalAccessTokens\Actions;

use DavorMinchorov\PersonalAccessTokens\Queries\CreateAccessTokenQuery;
use DavorMinchorov\Users\Models\User;

class CreateAccessTokenAction
{
    public function __construct(private CreateAccessTokenQuery $createAccessTokenQuery)
    {
    }

    /**
     * Creates a named access token for a specific user.
     *
     * @param User $user
     * @param string $tokenName
     *
     * @return string
     */
    public function __invoke(User $user, string $tokenName): string
    {
        return ($this->createAccessTokenQuery)(user: $user, tokenName: $tokenName);
    }
}
