<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;



    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function candidate() {
        return $this->belongsTo(Candidate::class);
    }

    public function election() {
        return $this->belongsTo(Election::class);
    }

    public function position() {
        return $this->belongsTo(Position::class);
    }
}
