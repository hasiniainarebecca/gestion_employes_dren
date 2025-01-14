<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $fillable = ['nom',
                            'a_propos',]; // Adaptez selon les colonnes de votre table

    public function employes()
    {
        return $this->hasMany(Employes::class, 'service_id');
    }
}
