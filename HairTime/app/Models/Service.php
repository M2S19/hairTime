<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';

    public function salons()
    {
        return $this->belongsToMany(SalonCoiffure::class, 'salon_services', 'service_id', 'salon_coiffures_id')
                    ->withPivot('genre', 'description', 'duree', 'prix');
    }
    
    public function salonServices()
    {
        return $this->hasMany(SalonCoiffureService::class, 'salon_coiffures_id');
    }
}
