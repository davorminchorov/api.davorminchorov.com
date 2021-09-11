<?php

namespace DavorMinchorov\Users\Queries;

use DavorMinchorov\Users\Models\User;

class GetUserByEmailQuery
{
    /**
     * GetUserByEmailQuery constructor.
     *
     * @param User $user
     */
    public function __construct(private User $user)
    {
        //
    }

    /**
     * Returns a user model based on the email address if one is found.
     *
     * @param string $email
     *
     * @return User
     */
    public function __invoke(string $email): User
    {
        $user = $this->user->newQuery()->where('email', $email)->first();

        /** @var User $user */
        return $user ?? $this->user;
    }
}
