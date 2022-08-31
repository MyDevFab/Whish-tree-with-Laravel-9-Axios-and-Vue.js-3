<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResolutionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'onhold'=> $this->onhold,
            'title' => $this->title,
            'checked' => $this->checked,
            'deadline' => $this->deadline,
            'category_id' => $this->category_id,
            'tree_id'=> $this->tree_id,
            'todos' => TodoResource::collection($this->todos)
        ];
    }
}
