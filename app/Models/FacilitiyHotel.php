<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilitiyHotel extends Model
{
    use HasFactory;
    protected $table = 'facility_hotel';

    protected $fillable = [
        'facility_id',
        'hotel_id',
    ];
}
