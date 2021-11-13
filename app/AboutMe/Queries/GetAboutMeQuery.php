<?php

namespace DavorMinchorov\AboutMe\Queries;

use DavorMinchorov\AboutMe\Models\AboutMe;

class GetAboutMeQuery
{
    /**
     * GetAboutMeQuery constructor.
     *
     * @param AboutMe $aboutMe
     */
    public function __construct(private AboutMe $aboutMe)
    {

    }

    /**
     * Gets the about me information about Davor Minchorov.
     *
     * @return AboutMe
     */
    public function __invoke(): AboutMe
    {
        $aboutMe = $this->aboutMe->newQuery()->first();

        /** @var AboutMe|null $aboutMe */
        return $aboutMe ?? $this->aboutMe;
    }
}
