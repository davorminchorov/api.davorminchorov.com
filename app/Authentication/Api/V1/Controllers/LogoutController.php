<?php

namespace DavorMinchorov\Authentication\Api\V1\Controllers;

use DavorMinchorov\Authentication\Actions\LogoutAction;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class LogoutController
{
    /**
     * LogoutController constructor.
     *
     * @param LogoutAction $logoutAction
     */
    public function __construct(private LogoutAction $logoutAction)
    {
    }

    /**
     * Logs the administrator out of the application.
     */
    public function __invoke(): Response
    {
        ($this->logoutAction)();

        return new Response(content: null, status: SymfonyResponse::HTTP_NO_CONTENT);
    }
}
