<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soldier extends Model
{
    use HasFactory;

    protected $table='soldiers';

    protected $fillable = [
        'id',
        'name',
        'attack',
        'life',
        'fk_soldier_type',
        'fk_ship'
    ];

    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }

    public function SoldierType()
    {
        return $this->belongsTo(SoldierType::class);
    }
}
