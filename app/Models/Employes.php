<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employes extends Model
{
    use HasFactory;
    protected $guarded = [''];
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'contact',
        'date_naissance',
        'sexe',
        'montant_journalier',
        'service_id',
        'photo'
    ];

    public function service()
    {
        return $this->belongsTo(Services::class, 'service_id');
    }

    public function getPhotoUrlAttribute()
    {
    return $this->photo ? asset('storage/' . $this->photo) : null;
    }
}
