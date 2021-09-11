<?php

namespace DavorMinchorov\Users\Actions;

use DavorMinchorov\Users\Models\User;
use DavorMinchorov\Users\Queries\DeleteAccessTokenByNameQuery;

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
