<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{

    public function toArray($request)
    {
        return [
        'id' => $this->id,
        'resolution_id' => $this->resolution_id,
        'content' => $this->content,
        'checked' => $this->checked,

    ];
    }
}
