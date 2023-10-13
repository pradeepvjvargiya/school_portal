<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    public function documents()
    {
        return $this->hasMany(StudentDocument::class);
    }

    // public function getRoleAttribute()
    // {
    //     return $this->attributes['role'];
    // }

    protected $fillable = [
    'role'.
        'name',
    'father_name',
    'mobile',
    'email',
    'password',
    'address',
    'city',
    'state',
    'image'
];
    use HasFactory;
}
