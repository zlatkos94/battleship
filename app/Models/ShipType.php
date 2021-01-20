<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipType extends Model
{
    use HasFactory;
    protected $table='ship_types';

    protected $fillable = [

        'name',
        'power',
        'fk_accident_protect',
    ];

    public function accident()
    {
        return $this->belongsTo(Accident::class);
    }

    public function ship()
    {
        return $this->hasMany(Ship::class);
    }
}
