<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"                => $this->id,
            "first_name"        => $this->first_name,
            "last_name"         => $this->last_name,
            "phone_number"      => $this->phone_number,
            "email"             => $this->email,
            "registration_date" => $this->registration_date,
            "created_by"        => $this->creator,
            "created_at"        => $this->created_at,
            "updated_by"        => $this->editor,
            "updated_at"        => $this->updated_at,
        ];
    }
}
