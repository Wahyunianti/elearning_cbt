<?php

namespace App\Models;

use App\Http\Controllers\KegiatanController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Model;

class Submit extends Model
{
    use HasFactory;

    protected $table = 'submisi';
    protected $fillable = ['lampiran', 'nilai', 'users_id', 'latihan_soal_id'];

    public function latihan_soal() {
        return $this->belongsTo(Latihan_soal::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
