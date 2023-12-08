<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $fillable = [
        'contenu',
        'estlu',
        'user_id',
        'estArchive'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
