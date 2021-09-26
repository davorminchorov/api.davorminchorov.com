<?php

namespace DavorMinchorov\Authentication\Api\V1\Controllers;

use DavorMinchorov\Authentication\Actions\LoginAction;
use DavorMinchorov\Authentication\Api\V1\ApiResources\LoginJsonResource;
use DavorMinchorov\Authentication\Api\V1\FormRequests\LoginFormRequest;
use DavorMinchorov\Authentication\DataTransferObjects\LoginDataTransferObject;

class LoginController
{
    /**
     * LoginController constructor.
     *
     * @param LoginAction $loginAction
     */
    public function __construct(private LoginAction $loginAction)
    {
        //
    }

    /**
     * Log the administrator in the administration area of the application.
     *
     * @param LoginFormRequest $loginFormRequest
     *
     * @return LoginJsonResource
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function __invoke(LoginFormRequest $loginFormRequest): LoginJsonResource
    {
        return LoginJsonResource::make(
            resource: ($this->loginAction)(
                loginDataTransferObject: LoginDataTransferObject::fromRequest($loginFormRequest)
            )
        );
    }
}
