<?php

namespace App\Models;

class Author extends BaseModel
{
    protected $fillable = [
        "name",
        "bio",
        "created_by",
        "updated_by",
    ];
}
