<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MaterielProjet extends Pivot
{
    protected $table = 'materiel_projets';

//    protected $fillable = [
//        'hours',
//        'somme'
//    ];
    use HasFactory;

    public function projet()
    {
        return $this->belongsTo(Projet::class,'projet_id');
    }
    public function materiel()
    {
        return $this->belongsTo(materiel::class,'materiel_id');
    }
}
