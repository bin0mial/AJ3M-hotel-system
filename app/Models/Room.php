<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected function getReservedAttribute($value){
        $val = null;
        if($value == 0){
            $val = "No";
        } else {
            $val = "Yes";
        }
        return $val;
    }

    public function reserve(){
        $this::update(["reserved" => 1]);
    }

    public function setPriceAttribute($value){
        $this->attributes['price'] = $value*100;
    }

    public function getPriceAttribute($value){
        return "$".$value/100;
    }

    public function getNormalPrice(){
        return $this->attributes['price']/100;
    }

    public function floor(){
        return $this->belongsTo(Floor::class);
    }

    public function manager(){
        return $this->belongsTo(Manager::class);
    }

    public function client_reservation(){
        return $this->hasMany(ClientReservation::class);
    }

}
