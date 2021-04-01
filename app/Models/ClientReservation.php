<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReservation extends Model
{
    use HasFactory;
    protected $fillable = [
        "accompany_number",
        "room_number",
        "paid_price"
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

 

}
