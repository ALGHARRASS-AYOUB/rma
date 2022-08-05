<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable=[
        'first_name',
        'last_name',
        'email',
        'tel_number',
        'res_date',
        'meal',
        'guests_number',
        'table_id',
    ];

    protected $dates=[
        'res_date',
    ];

    // the few lines above could be the same as those lines in the bottom, so instead of having casts attr and then assign the value date to res_date key ,  we can just make the attr dates and have the key inside
    // protected $casts=[
    //     'res_date'=>'date',
    // ];

    public function table(){
        return $this->belongsTo(Table::class);
    }
}
