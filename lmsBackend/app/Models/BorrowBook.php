<?php

namespace App\Models;

class BorrowBook extends BaseModel
{
    protected $fillable = [
        "id",
        "member_id",
        "book_id",
        "borrow_date",
        "return_date",
        "status"
    ];

    /**
     * Get the user that owns the BorrowBook
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

}
