<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $fillable = [
        'foto',
        'users_id',
    ];

    public function user():BelongsTo
    {
        return $this->BelongsTo(User::class, 'users_id');
    }

    public function kelaseh():HasMany
    {
        return $this->hasMany(Kelas::class);
    }

    public function latsol(): HasOne {
        return $this->hasOne(Siswa::class, 'guru_id');
    }

}
