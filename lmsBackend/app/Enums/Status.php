<?php

namespace App\Enums;
use App\Traits\EnumToArray;

enum Status: string
{
    use EnumToArray;

    case BORROWED = 'borrowed';
    case RETURNED = 'returned';
    case OVERDUE  = 'overdue';
   
}
