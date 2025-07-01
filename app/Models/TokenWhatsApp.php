<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenWhatsApp extends Model
{
    use HasFactory;

    protected $table = 'token_whatsapp';

    protected $fillable = [
        'token_whatsapp'
    ];

}
