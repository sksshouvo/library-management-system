<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "bio" => $this->bio,
            "created_by" => $this->creator,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "updated_by" => $this->editor,
        ];
    }
}
