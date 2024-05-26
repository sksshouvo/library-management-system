<?php

namespace App\Models;

class Member extends BaseModel
{
    protected $fillable = [
        "first_name",
        "last_name",
        "phone_number",
        "email",
        "registration_date"
    ];
}
