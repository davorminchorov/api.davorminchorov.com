<?php

namespace DavorMinchorov\Authentication\Api\V1\Controllers;

use DavorMinchorov\Authentication\Actions\LogoutAction;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Response;

class LogoutController
{

    /**
     * LogoutController constructor.
     *
     * @param LogoutAction $logoutAction
     * @param AuthManager $auth
     */
    public function __construct(private LogoutAction $logoutAction, private AuthManager $authManager)
    {

    }

    /**
     * Logs the administrator out of the application.
     */
    public function __invoke(): Response
    {
        ($this->logoutAction)(user: $this->authManager->guard()->user());

        return new Response(content: null, status: Response::HTTP_NO_CONTENT);
    }
}
