<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'start_date', 'end_date'
    ];

    public function positions() {
        return $this->hasMany(Position::class);
    }

    public function votes() {
        return $this->hasMany(Vote::class);
    }
}
