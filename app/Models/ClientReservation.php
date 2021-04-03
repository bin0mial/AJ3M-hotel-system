<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        "client_id",
        "accompany_number",
        "room_number",
        "room_id",
        "paid_price",
        "days",
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }






}
