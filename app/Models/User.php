<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'id',
        'nama',
        'username',
        'email',
        'password',
        'no_induk',
        'role_id'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function roles(): BelongsTo {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function isGuru()
    {
        return $this->roles->role_name == 'guru';
    }

    public function isSiswa()
    {
        return $this->roles->role_name == 'siswa';
    }

    public function hasil(): HasOne
    {
        return $this->hasOne(Hasil::class, 'users_id');
    }

    public function submit(): HasOne
    {
        return $this->hasOne(Submit::class, 'users_id');
    }

    public function guru(): HasOne {
        return $this->hasOne(Guru::class, 'users_id');
    }

    public function siswa(): HasOne {
        return $this->hasOne(Siswa::class, 'users_id');
    }

}
