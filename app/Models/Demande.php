<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function montore()
    {
        return $this->belongsTo(User::class, 'userMentore_id');
    }

    public function montor()
    {
        return $this->belongsTo(User::class, 'userMentor_id');
    }
}
