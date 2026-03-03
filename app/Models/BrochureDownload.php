<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrochureDownload extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
    ];
}
