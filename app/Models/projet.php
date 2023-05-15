<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'adress',
        'charges',
        'produits',
        'balance',
        'numEmployes',
    ];
    public function articles()
    {
        return $this->belongsToMany(entrepot::class,'utilisations','projet_id','entrepot_id');
    }

    public function clients()
    {
        return $this->belongsToMany(client::class);
    }
}
