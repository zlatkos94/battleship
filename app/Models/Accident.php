<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    use HasFactory;

    protected $table='accidents';

    protected $fillable = [
        'id',
        'name',
        'mortality_rate',
        'probability_percentage'
    ];

    public function ShipType()
    {
        return $this->hasMany(ShipType::class);
    }
}
