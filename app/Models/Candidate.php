<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;


    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function position() {
        return $this->belongsTo(Position::class);
    }

    public function election() {
        return $this->belongsTo(Election::class);
    }

    public function votes() {
        return $this->hasMany(Vote::class);
    }
}
