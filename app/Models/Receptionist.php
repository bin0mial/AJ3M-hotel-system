<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receptionist extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function manager(){
        return $this->belongsTo(Manager::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
