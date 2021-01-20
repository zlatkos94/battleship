<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;
    protected $table='ships';

    protected $fillable = [

        'name',
        'fk_ship_type',
    ];

    public function Soldier()
    {
        return $this->hasMany(Soldier::class);
    }
    public function ShipType()
    {
        return $this->belongsTo(ShipType::class);
    }
}
