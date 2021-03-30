<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        "mobile",
        "country",
        "gender"
    ];


    public function receptionist(){
        return $this->belongsTo(Receptionist::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
