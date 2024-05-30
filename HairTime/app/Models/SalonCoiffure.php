<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salonCoiffure extends Model
{

    protected $table = 'salon_coiffures';
 //   public function coiffeurs()
  //  {
   //     return $this->belongsTo(compteCoiffeur::class, 'salon_id');
  //  }
  protected $fillable = ['nom', 'ville', 'description'];

  public function coiffeurs()
  {
      // Cette relation récupère tous les comptes coiffeurs associés à ce salon.
    return $this->hasMany(compteCoiffeur::class, 'salon_id');
  }
  
  public function services()
  {
      return $this->belongsToMany(Service::class, 'salon_services', 'salon_coiffures_id', 'service_id')
                  ->withPivot('genre', 'description', 'duree', 'prix');
  }

  public function salonServices()
  {
      return $this->hasMany(SalonCoiffureService::class, 'salon_coiffures_id');
  }

  public function photos()
  {
    return $this->hasMany(Photo::class, 'salon_id');
  }

  public function creneau() 
  {
    return $this->hasMany(creneau::class);
  }
    use HasFactory;
}
