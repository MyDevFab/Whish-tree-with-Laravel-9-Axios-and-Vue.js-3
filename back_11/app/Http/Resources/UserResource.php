<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'avatar' => $this->avatar,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'friends' => $this->friends,
            'categories' => CategoryResource::collection($this->categories),
            'trees' => TreeResource::collection($this->trees),
        ];
    }
}