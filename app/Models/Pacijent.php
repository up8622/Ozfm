<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pacijent extends Model
{
    use HasFactory;

    protected $table = 'pacijent';

    protected $guarded = [];

    public function termins()
    {
        return $this->hasMany(Termin::class);
    }
}
