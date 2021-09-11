<?php

namespace DavorMinchorov\PersonalAccessTokens\Actions;

use DavorMinchorov\PersonalAccessTokens\Queries\DeleteAccessTokenByNameQuery;
use DavorMinchorov\Users\Models\User;

class DeleteAccessTokenAction
{
    /**
     * DeleteApiTokenAction constructor.
     *
     * @param DeleteAccessTokenByNameQuery $deleteAccessTokenByNameQuery
     */
    public function __construct(private DeleteAccessTokenByNameQuery $deleteAccessTokenByNameQuery)
    {

    }

    /**
     * Revokes the access token by a specific token name for a specific user.
     *
     * @param string $tokenName
     *
     * @param User $user
     * @return int|null
     */
    public function __invoke(string $tokenName, User $user): int|null
    {
        return ($this->deleteAccessTokenByNameQuery)( tokenName: $tokenName, user: $user);
    }
}
