<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'guests_number',
        'location',
        'status',
    ];

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
