<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeUpdate extends Model
{
    use HasFactory;
    protected $fillable = ['codigo','activo'];
}
