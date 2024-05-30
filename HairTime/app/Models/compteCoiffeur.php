<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class compteCoiffeur extends Model
{
    use HasFactory;

    protected $table = 'compte_coiffeurs';
    protected $primaryKey = 'users_id';
    public function salon()
    {
        return $this->belongsTo(SalonCoiffure::class, 'salon_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    

    // Si vous souhaitez autoriser l'assignation en masse pour certains champs, spécifiez-les ici :
    protected $fillable = ['users_id', 'specialite', 'salon_id'];

}
