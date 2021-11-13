<?php

namespace DavorMinchorov\Blog\Api\V1\ApiResources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogTagJsonResource extends JsonResource
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
            'type' => 'blogTags',
            'attributes' => [
                'name' => $this->resource->name,
                'slug' => $this->resource->slug,
            ],
        ];
    }
}
