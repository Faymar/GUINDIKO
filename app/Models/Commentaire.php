<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commentaire extends Model
{
    use HasFactory;


    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    protected $fillable = [
        'contenu',
        'estArchive',
    ];
}
