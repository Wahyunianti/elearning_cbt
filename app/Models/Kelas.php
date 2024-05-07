<?php

namespace App\Models;

use App\Http\Controllers\KegiatanController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = ['kelas', 'guru_id'];

    public function guru() {
        return $this->belongsTo(Guru::class);
    }
}
