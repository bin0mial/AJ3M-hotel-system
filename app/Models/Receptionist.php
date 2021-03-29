<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    use HasFactory;

    public function manager(){
        return $this->belongsTo(Manager::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
