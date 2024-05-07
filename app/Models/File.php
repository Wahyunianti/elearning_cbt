<?php

namespace App\Models;

use App\Http\Controllers\KegiatanController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'file_latsol';
    protected $fillable = ['file', 'latihan_soal_id'];

    public function latihan_soal() {
        return $this->belongsTo(Latihan_soal::class);
    }
}
