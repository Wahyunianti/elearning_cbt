<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;
    
       protected $table = 'e-book';
       protected $fillable = ['judul', 'file'];

}
