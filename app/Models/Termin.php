<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Termin extends Model
{
    use HasFactory;

    public const TRAJANJE_MINUTA = 60;

    protected $table = 'termin';

    protected $guarded = [];

    protected $casts = [
        'vreme' => 'datetime',
    ];

    public function scopePreklapaSe(Builder $query, Carbon $vreme): Builder
    {
        return $query
            ->where('vreme', '>', $vreme->copy()->subMinutes(self::TRAJANJE_MINUTA))
            ->where('vreme', '<', $vreme->copy()->addMinutes(self::TRAJANJE_MINUTA));
    }

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
