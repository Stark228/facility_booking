<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'subcategory_id',
        'user_id',
        'start_date',
        'start_time',
        'end_time',
        'additional_requirement',
        'reason',
        'status',
        'phone_no',
    ];

    // Define the relationship with the Subcategory model
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
