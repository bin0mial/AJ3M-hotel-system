<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Manager extends Model
{
    use HasFactory, HasRoles;

    protected $fillable = [
        "manager_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "manager_id");
    }

    public function receptionists(){
        return $this->hasMany(Receptionist::class);
    }
}
