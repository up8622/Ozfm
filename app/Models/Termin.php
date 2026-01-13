<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Termin extends Model
{
    use HasFactory;

    protected $table = 'termin';

    protected $guarded = [];

    protected $casts = [
        'vreme' => 'datetime',
    ];

    public function pacijent()
    {
        return $this->belongsTo(Pacijent::class);
    }

    public function terapeut()
    {
        return $this->belongsTo(Terapeut::class);
    }

    public function usluga()
    {
        return $this->belongsTo(Usluga::class);
    }
}
