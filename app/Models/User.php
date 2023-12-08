<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class);
    }
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
    public function message()
    {
        return $this->hasMany(Message::class);
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    public function diplomes()
    {
        return $this->hasMany(Diplome::class);
    }

    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
