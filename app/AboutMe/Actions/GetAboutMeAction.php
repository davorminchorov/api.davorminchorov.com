<?php

namespace DavorMinchorov\AboutMe\Actions;

use DavorMinchorov\AboutMe\Models\AboutMe;
use DavorMinchorov\AboutMe\Queries\GetAboutMeQuery;

class GetAboutMeAction
{
    /**
     * GetAboutMeAction constructor.
     *
     * @param GetAboutMeQuery $getAboutMeQuery
     */
    public function __construct(private GetAboutMeQuery $getAboutMeQuery)
    {
        //
    }

    /**
     * Gets a list of blog tags.
     */
    public function __invoke(): AboutMe
    {
        return ($this->getAboutMeQuery)();
    }
}
