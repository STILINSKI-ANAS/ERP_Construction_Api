<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class WorkerProjet extends Pivot
{
    protected $table = 'projet_workers';

//    protected $fillable = [
//        'projet_id',
//        'worker_id',
//        'hours',
//        'somme'
//    ];

    use HasFactory;

    public function projet()
    {
        return $this->belongsTo(Projet::class,'projet_id');
    }
    public function worker()
    {
        return $this->belongsTo(worker::class,'worker_id');
    }
}
