<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    protected $table = 'hasil';
    protected $fillable = ['nilai', 'kuis_id', 'users_id'];

    public function quiz() {
        return $this->belongsTo(Kuis::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
