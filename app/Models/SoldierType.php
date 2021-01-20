<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldierType extends Model
{
    use HasFactory;

    protected $table='soldier_types';

    protected $fillable = [

        'name',
    ];
    public function soldier()
    {
        return $this->hasMany(Soldier::class);
    }
}
