<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'address',
        'zip_code',
        'date_of_birth',
        'date_hired',
        'country_id', // Tambahkan ini
        'state_id',   // Tambahkan ini jika state_id juga diperlukan
        'city_id',    // Tambahkan ini jika city_id juga diperlukan
        'department_id', // Dan ini jika department_id juga diperlukan
    ];

    // Relasi ke tabel Country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // Relasi ke tabel State
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    // Relasi ke tabel City
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Relasi ke tabel Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
