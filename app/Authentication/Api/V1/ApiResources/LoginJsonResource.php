<?php

namespace DavorMinchorov\Authentication\Api\V1\ApiResources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginJsonResource extends JsonResource
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
            'type' => 'users',
            'attributes' => [
                'name' => $this->name,
                'accessToken' => $this->access_token,
            ],
        ];
    }
}
