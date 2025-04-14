<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'year', 'section',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function votes() {
        return $this->hasMany(Vote::class);
    }

    public function candidacies() {
        return $this->hasMany(Candidate::class);
    }
}
