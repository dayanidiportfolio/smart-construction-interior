<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        "role",
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class,'user_id'); 
    }

    public function products()
    {
        return $this->hasMany(Products::class,'user_id'); 
    }

    public function customers()
    {
        return $this->hasMany(Customers::class,'user_id'); 
    }

    public function reminders()
    {
        return $this->hasMany(Reminders::class,'user_id'); 
    }

    public function getUser()
    {
        return $this->belongsTo(Customers::class,'user_id');
    }


}
