<?php

namespace DavorMinchorov\Users\Actions;

use DavorMinchorov\Users\Models\User;
use DavorMinchorov\Users\Queries\CreateAccessTokenQuery;

class CreateAccessTokenAction
{
    public function __construct(private CreateAccessTokenQuery $createAccessTokenQuery)
    {

    }

    /**
     * Creates the API token for a specific user.
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
