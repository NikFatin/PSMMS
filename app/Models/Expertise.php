<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    use HasFactory;

    protected $fillable = [
        'expertise',
        'description',
        'level',
        'supervisor_id',
    ];

    public function supervisor()
    {
      return $this->belongsTo(Supervisor::class);
    }
}
