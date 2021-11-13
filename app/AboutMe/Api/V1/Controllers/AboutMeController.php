<?php

namespace DavorMinchorov\AboutMe\Api\V1\Controllers;

use DavorMinchorov\AboutMe\Actions\GetAboutMeAction;
use DavorMinchorov\AboutMe\Api\V1\ApiResources\AboutMeJsonResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutMeController
{
    /**
     * AboutMeController constructor.
     *
     * @param GetAboutMeAction $getAboutMeAction
     */
    public function __construct(private GetAboutMeAction $getAboutMeAction)
    {
        //
    }

    /**
     * Gets the about me information for Davor Minchorov
     */
    public function __invoke(): JsonResource
    {
        return AboutMeJsonResource::make(
            resource: ($this->getAboutMeAction)()
        );
    }
}
