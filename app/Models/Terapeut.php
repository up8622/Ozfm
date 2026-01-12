<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Terapeut extends Model
{
    use HasFactory;

    protected $table = 'terapeut';

    protected $fillable = [
        'ime',
        'prezime',
        'jmbg',
        'broj_telefona',
        'username',
        'password_hash',
    ];
}
