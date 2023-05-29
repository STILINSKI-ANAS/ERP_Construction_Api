<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class worker extends Model
{

    protected $fillable = [
        'title',
        'hourly_rate',
    ];

    use HasFactory;

    public function projets()
    {
        return $this->belongsToMany(projet::class);
    }
}
