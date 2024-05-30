<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salonCoiffureService extends Model
{
    use HasFactory;
    
    protected $table = "salon_servies";

    public function salonCoiffure()
    {
        return $this->belongsTo(SalonCoiffure::class, 'salon_coiffures_id');
    }

    // Relation avec le modèle Service
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
