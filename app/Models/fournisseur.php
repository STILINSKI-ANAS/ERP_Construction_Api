<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fournisseur extends Model
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

    public function articles()
    {
        return $this->belongsToMany(entrepot::class,'commandes','fournisseur_id','entrepot_id');
    }
}
