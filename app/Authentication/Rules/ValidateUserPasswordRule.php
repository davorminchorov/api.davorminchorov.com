<?php

namespace DavorMinchorov\Authentication\Rules;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Validation\ValidationException;

class ValidateUserPasswordRule
{
    /**
     * ValidateUserPasswordRule constructor.
     *
     * @param Hasher $hasher
     */
    public function __construct(private Hasher $hasher)
    {

    }

    /**
     * Checks if the provided password matches any user password.
     *
     * @param string $password
     * @param string|null $userPassword
     *
     * @return bool
     */
    public function __invoke(string $password, ?string $userPassword): bool
    {
        if ($this->hasher->check(value: $password, hashedValue: $userPassword ?? '')) {
            return true;
        }

        throw ValidationException::withMessages(messages: [
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
}
