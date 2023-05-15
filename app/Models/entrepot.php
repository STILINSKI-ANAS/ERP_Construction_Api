<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entrepot extends Model
{
    protected $table = 'entrepot';
    use HasFactory;

    protected $fillable = [
        "name",
        "Identifiant",
        "prix_achat",
        "prix_vente",
        "category",
        "quantity"
    ];

    public function fournisseurs()
    {
        return $this->belongsToMany(fournisseur::class,'commandes','entrepot_id','fournisseur_id');
    }
    public function projets()
    {
        return $this->belongsToMany(projet::class,'utilisations','entrepot_id','projet_id');
    }
}
