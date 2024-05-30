<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = ['salon_id', 'path'];
    protected $table = 'photos';
    public function salon()
    {
        return $this->belongsTo(SalonCoiffure::class, 'salon_coiffures_id');
    }

}
