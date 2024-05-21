<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "title"        => $this->title,
            "published_at" => $this->published_at,
            "ISBN"         => $this->ISBN,
            "total_copies" => $this->total_copies,
            "author_id"    => $this->author_id,
            "created_by"   => $this->creator,
            "created_at"   => $this->created_at,
            "updated_by"   => $this->editor,
            "updated_at"   => $this->updated_at
        ];
    }
}
