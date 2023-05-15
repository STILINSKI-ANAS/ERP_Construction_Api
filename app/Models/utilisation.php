<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class utilisation extends Pivot
{
    protected $table ='utilisations';
    use HasFactory;

    public function projet()
    {
        return $this->belongsTo(Projet::class,'projet_id');
    }
    public function article()
    {
        return $this->belongsTo(entrepot::class,'entrepot_id');
    }
}
