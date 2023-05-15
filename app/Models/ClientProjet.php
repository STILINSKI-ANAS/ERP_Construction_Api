<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClientProjet extends Pivot
{
    use HasFactory;
    protected $table = 'client_projet';

    public function projet()
    {
        return $this->belongsTo(Projet::class,'projet_id');
    }
    public function client()
    {
        return $this->belongsTo(client::class,'client_id');
    }
}
