<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Pilgan extends Model
{
    use HasFactory;

    protected $table = 'pilihan_ganda';
    protected $fillable = ['question', 'options', 'correct_option', 'kuis_id'];

    public function quiz() {
        return $this->belongsTo(Kuis::class);
    }
}