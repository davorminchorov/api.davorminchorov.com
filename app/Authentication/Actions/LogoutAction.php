<?php

namespace DavorMinchorov\Authentication\Actions;

use DavorMinchorov\Authentication\DataTransferObjects\LoginDataTransferObject;
use DavorMinchorov\Authentication\Rules\ValidateUserPasswordRule;
use DavorMinchorov\Users\Actions\CreateAccessTokenAction;
use DavorMinchorov\Users\Enums\AccessTokenName;
use DavorMinchorov\Users\Models\User;
use DavorMinchorov\Users\Queries\GetUserByEmailQuery;
use DavorMinchorov\Users\Queries\RevokeAccessTokenByNameQuery;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class LogoutAction
{
    /**
     * LogoutAction constructor.
     *
     * @param RevokeAccessTokenByNameQuery $revokeAccessTokenByNameQuery
     */
    public function __construct(private RevokeAccessTokenByNameQuery $revokeAccessTokenByNameQuery)
    {

    }

    /**
     * Log the administrator out of the administration panel.
     *
     * @param User|Authenticatable $user
     *
     * @return int
     */
    public function __invoke(User|Authenticatable $user): int
    {
        return ($this->revokeAccessTokenByNameQuery)($user, AccessTokenName::API_AUTHENTICATION);
    }
}
