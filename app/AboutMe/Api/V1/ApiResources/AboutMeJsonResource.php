<?php

namespace DavorMinchorov\AboutMe\Api\V1\ApiResources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutMeJsonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->uuid,
            'type' => 'aboutMe',
            'attributes' => [
                'content' => $this->resource->content,
            ],
        ];
    }
}
