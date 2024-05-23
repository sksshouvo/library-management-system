<?php

namespace App\Models;

class Member extends BaseModel
{
    use HasFactory, Userstamps;

    protected $fillable = [
        "first_name",
        "last_name",
        "phone_number",
        "email",
        "registration_date"
    ];
}
