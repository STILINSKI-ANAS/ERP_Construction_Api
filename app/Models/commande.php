<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\Pivot;
class commande extends Pivot
{
    use HasFactory;

    protected $table = 'commandes';

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class,'fournisseur_id');
    }
    public function article()
    {
        return $this->belongsTo(entrepot::class,'entrepot_id');
    }
}
