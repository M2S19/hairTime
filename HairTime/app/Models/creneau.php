<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class creneau extends Model
{
    use HasFactory;

    protected $table = 'creneaux';
    public function salon_coiffures()
    {
        return $this->belongsTo(SalonCoiffure::class);
    }
}
