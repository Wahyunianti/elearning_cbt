<?php

namespace App\Models;

use App\Http\Controllers\KegiatanController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;

    protected $table = 'kuis';
    protected $fillable = ['nama', 'bab', 'jenis', 'duration'];

    public function questions(): HasMany {
        return $this->hasMany(Pilgan::class);
    }

    public function bacaan(): HasOne {
        return $this->hasOne(Bacaan::class);
    }

    public function hasil(): HasMany {
        return $this->hasMany(Hasil::class);
    }

}
