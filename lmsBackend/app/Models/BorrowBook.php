<?php

namespace App\Models;

class BorrowBook extends BaseModel
{
    use HasFactory, Userstamps;

    protected $fillable = [
        "id",
        "member_id",
        "book_id",
        "borrow_date",
        "return_date",
        "status"
    ];
}
