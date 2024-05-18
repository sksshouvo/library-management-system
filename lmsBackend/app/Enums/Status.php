<?php

namespace App\Enums;
use App\Traits\EnumToArray;

enum Status: string
{
    use EnumToArray;

    case BORROWED = 'borrowd';
    case RETURNED = 'returned';
    case OVERDUE  = 'overdue';
   
}
