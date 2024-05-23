<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class BaseModel extends Model {
    use HasFactory, Userstamps;

    public function scopeWhereId($query, $id) {
        $query->where("id", $id);
    }
}

