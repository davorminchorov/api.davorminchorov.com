<?php

namespace DavorMinchorov\Users\Queries;

use DavorMinchorov\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

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
     * @return User|Model|null
     */
    public function __invoke(string $email): User|Model|null
    {
        return $this->user->newQuery()->where('email', $email)->first();
    }
}