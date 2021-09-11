<?php

namespace DavorMinchorov\Authentication\Rules;

use DavorMinchorov\Users\Models\User;
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
     * @param User|null $user
     *
     * @return User
     */
    public function __invoke(string $password, ?User $user): User
    {
        if ($user && $this->hasher->check(value: $password, hashedValue: $user->password)) {
            return $user;
        }

        throw ValidationException::withMessages(messages: [
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
}
