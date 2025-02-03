<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    /* ---- relationship bettween categories and estates table */
    public function estates()
    {
        return $this->hasmany(Estate::class);
    }
}

