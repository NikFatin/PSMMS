<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'supervisor_id',
    ];

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }
}
