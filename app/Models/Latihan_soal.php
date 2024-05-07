<?php

namespace App\Models;

use App\Http\Controllers\KegiatanController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Model;

class Latihan_soal extends Model
{
    use HasFactory;

    protected $table = 'latihan_soal';
    protected $fillable = ['nama', 'bab', 'keterangan', 'tenggat', 'ubah', 'guru_id'];

    public function submit(): HasOne {
        return $this->hasOne(Submit::class);
    }

    public function files(): HasMany {
        return $this->hasMany(File::class);
    }

    public function guru() {
        return $this->belongsTo(Guru::class);
    }

}
