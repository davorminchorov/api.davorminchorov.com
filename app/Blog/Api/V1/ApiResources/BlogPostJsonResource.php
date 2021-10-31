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
            'id' => $this->uuid,
            'type' => 'blogPosts',
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'excerpt' => $this->excerpt,
                'content' => $this->content,
                'publishDate' => $this->published_at->format('F j, Y H:i:s'),
            ],
            'relationships' => [
                'tags' => [
                    'data' => BlogTagJsonResource::collection(resource: $this->whenLoaded(relationship: 'blogTags'))
                ],
            ]
        ];
    }
}
