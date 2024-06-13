<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = ['facility_name', 'category_id', 'image', 'resource', 'subcategorysession_id', 'method', 'slot', 'ed'];
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subcategorysession()
    {
        return $this->belongsTo(Subcategorysession::class, 'subcategorysession_id');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'subcategory_id');
    }
    public function availability()
    {
        return $this->hasMany(Availability::class, 'subcategory_id');
    }
    public function team()
    {
        return $this->hasOne(Team::class, 'subcategory_id');
    }
}
