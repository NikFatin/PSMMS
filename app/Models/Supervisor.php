<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
        'quota',
        'user_id',
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function expertises(){
      return $this->hasMany(Expertise::class);
    }

    public function titles(){
      return $this->hasMany(Title::class);
    }
}
