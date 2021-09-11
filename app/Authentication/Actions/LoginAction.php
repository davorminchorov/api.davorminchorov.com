<?php

namespace DavorMinchorov\Authentication\Actions;

use DavorMinchorov\Authentication\DataTransferObjects\LoginDataTransferObject;
use DavorMinchorov\Authentication\Rules\ValidateUserPasswordRule;
use DavorMinchorov\PersonalAccessTokens\Actions\CreateAccessTokenAction;
use DavorMinchorov\PersonalAccessTokens\Enums\AccessTokenName;
use DavorMinchorov\Users\Models\User;
use DavorMinchorov\Users\Queries\GetUserByEmailQuery;
use Illuminate\Validation\ValidationException;

class LoginAction
{
    /**
     * LoginAction constructor.
     *
     * @param GetUserByEmailQuery $getUserByEmailQuery
     * @param ValidateUserPasswordRule $validateUserPasswordRule
     * @param CreateAccessTokenAction $createAccessTokenAction
     */
    public function __construct(
        private GetUserByEmailQuery $getUserByEmailQuery,
        private ValidateUserPasswordRule $validateUserPasswordRule,
        private CreateAccessTokenAction $createAccessTokenAction,
    ) {

    }

    /**
     * Log the administrator in the administration panel.
     *
     * @param LoginDataTransferObject $loginDataTransferObject
     *
     * @return User
     * @throws ValidationException
     */
    public function __invoke(LoginDataTransferObject $loginDataTransferObject): User
    {
        $user = ($this->getUserByEmailQuery)(email: $loginDataTransferObject->email);

        ($this->validateUserPasswordRule)(
            password: $loginDataTransferObject->password,
            userPassword: $user->password
        );

        $user->access_token = ($this->createAccessTokenAction)(user: $user, tokenName: AccessTokenName::API_AUTHENTICATION);

        return $user;
    }
}
