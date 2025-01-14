<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // Pas besoin de HasFactory si vous ne l'utilisez pas.
    
    protected $fillable = ['user_id', 'theme', 'language', 'dashboard_layout'];

    /**
     * Relation inverse avec User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}