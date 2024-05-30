<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalonService extends Model
{
    use HasFactory;

    protected $table = 'salon_services';

    public function salon()
    {
        return $this->belongsTo(SalonCoiffure::class, 'salon_coiffures_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'services_id');
    }
}
