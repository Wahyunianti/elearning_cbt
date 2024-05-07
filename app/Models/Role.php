<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
       protected $table = 'roles';
       protected $fillable = ['role_name'];

       public function users(): HasMany {
           return $this->hasMany(User::class);
       }
}
