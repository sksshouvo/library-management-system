<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Book extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        "title",
        "published_at",
        "ISBN",
        "total_copies",
        "author_id"
    ];
}
