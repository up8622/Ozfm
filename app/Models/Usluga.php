<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usluga extends Model
{
    use HasFactory;

    protected $table = 'usluga';

    protected $fillable = [
        'naziv',
        'cena',
    ];
}
