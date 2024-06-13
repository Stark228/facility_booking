<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategorysession extends Model
{
    protected $fillable = ['start_date', 'end_date', 'start_time', 'end_time'];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'subcategorysession_id');
    }
}
