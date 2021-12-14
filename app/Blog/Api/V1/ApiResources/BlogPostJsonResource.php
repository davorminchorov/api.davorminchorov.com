<?php

namespace DavorMinchorov\Blog\Api\V1\ApiResources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogPostJsonResource extends JsonResource
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
            'type' => 'blogPosts',
            'attributes' => [
                'title' => $this->resource->title,
                'slug' => $this->resource->slug,
                'excerpt' => $this->resource->excerpt,
                'content' => $this->resource->content,
                'publishDate' => $this->resource->published_at->format('F j, Y H:i:s'),
            ],
            'relationships' => [
                'tags' => [
                    'data' => BlogTagJsonResource::collection(resource: $this->whenLoaded(relationship: 'blogTags')),
                ],
            ],
        ];
    }
}
