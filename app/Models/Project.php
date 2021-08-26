<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'adress',
        'ssh',
        'admin_login',
        'admin_password'
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('permission');
    }
}
