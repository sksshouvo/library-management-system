<?php

namespace App\Models;

class Book extends BaseModel
{
    protected $fillable = [
        "title",
        "published_at",
        "ISBN",
        "total_copies",
        "author_id",
        "created_by",
        "updated_by",
    ];

    /**
     * Get the user that owns the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function scopeIsbnWiseFilter($query, $ISBN): void {
        $query->where("ISBN", $ISBN);
    }
}
