<?php

namespace DavorMinchorov\Authentication\Actions;

use DavorMinchorov\PersonalAccessTokens\Actions\DeleteAccessTokenAction;
use DavorMinchorov\PersonalAccessTokens\Enums\AccessTokenName;
use DavorMinchorov\Users\Models\User;
use Illuminate\Auth\AuthManager;

class LogoutAction
{
    /**
     * LogoutAction constructor.
     *
     * @param AuthManager $authManager
     * @param DeleteAccessTokenAction $deleteAccessTokenAction
     */
    public function __construct(
        private AuthManager $authManager,
        private DeleteAccessTokenAction $deleteAccessTokenAction
    ) {
    }

    /**
     * Log the administrator out of the administration panel.
     *
     * @return int|null
     */
    public function __invoke(): int|null
    {
        /** @var User $user */
        $user = $this->authManager->guard()->user();

        return ($this->deleteAccessTokenAction)(tokenName: AccessTokenName::API_AUTHENTICATION, user: $user);
    }
}
