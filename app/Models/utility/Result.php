<?php

namespace App\Models\utility;

use Illuminate\Support\Collection;

class Result 
{
    public Collection $questions;
    public int $correct;
    public int $incorrect;
    public int $unAnswered;
}