<?php

namespace DavorMinchorov\Authentication\DataTransferObjects;

use DavorMinchorov\Authentication\Api\V1\FormRequests\LoginFormRequest;
use Spatie\DataTransferObject\DataTransferObject;

class LoginDataTransferObject extends DataTransferObject
{
    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $password;

    /**
     * Populates the properties of the data transfer object from the request object.
     *
     * @param LoginFormRequest $loginFormRequest
     *
     * @return LoginDataTransferObject
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public static function fromRequest(LoginFormRequest $loginFormRequest): self
    {
        return new self([
            'email' => $loginFormRequest->input('email'),
            'password' => $loginFormRequest->input('password'),
        ]);
    }
}
