<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Menambahkan namespace untuk HasMany

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'phonecode',
    ];

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
