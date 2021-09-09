<?php

namespace DavorMinchorov\Users\Actions;

use DavorMinchorov\Users\Models\User;
use DavorMinchorov\Users\Queries\RevokeAccessTokenByNameQuery;

class DeleteAccessTokenAction
{
    /**
     * DeleteApiTokenAction constructor.
     *
     * @param RevokeAccessTokenByNameQuery $revokeAccessTokenByNameQuery
     */
    public function __construct(private RevokeAccessTokenByNameQuery $revokeAccessTokenByNameQuery)
    {

    }

    /**
     * Revokes the API token by a specific token name for a specific user.
     *
     * @param User $user
     * @param string $tokenName
     *
     * @return string
     */
    public function __invoke(User $user, string $tokenName): string
    {
        return ($this->revokeAccessTokenByNameQuery)(user: $user, tokenName: $tokenName);
    }
}
