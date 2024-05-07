<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Bacaan extends Model
{
    use HasFactory;

    protected $table = 'bacaan';
    protected $fillable = ['soal', 'jawaban', 'kuis_id'];

    public function quiz() {
        return $this->belongsTo(Kuis::class);
    }

}