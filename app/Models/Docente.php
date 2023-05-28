<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    protected $table = 'docentes';

    protected $fillable = [
        'nivel_id',
        'user_id',
        'grado',
        'seccion',
    ];

   
    public function user()
{
    return $this->belongsTo(User::class);
}

    public function nivel()
    {
        return $this->belongsTo(Niveledu::class);
    }
}


