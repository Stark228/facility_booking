<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usertype extends Model
{
    protected $fillable = ['type'];
    public function users()
    {
        return $this->hasMany(User::class, 'usertype_id');
    }
}
