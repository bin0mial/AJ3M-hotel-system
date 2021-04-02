<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Manager extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        "user_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function receptionists(){
        return $this->hasMany(Receptionist::class);
    }

    public function floors(){
        return $this->hasMany(Floor::class);
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }

}
