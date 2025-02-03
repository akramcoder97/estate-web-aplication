<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    use HasFactory;

    /*  relationship bettween categories ans estates table */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
