<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetCodePassord extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', // Remplacez "code" par les colonnes que vous utilisez
        'email', // Exemple
    ];
}
