<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'adress',
        'CIN',
        'balance',
        'email',
        'phoneNumber'
    ];

    public function projets()
    {
        return $this->belongsToMany(projet::class);
    }
}
