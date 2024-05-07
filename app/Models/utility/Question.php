<?php

namespace App\Models\utility;

class Question
{
    public int $id;
    public int $questionNo;
    public string $question;
    public string $correctOption;
    public array $options;
    public string $choosedAnswer = "0";
    public bool $correct = false;

}