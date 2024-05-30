<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $primaryKey = 'users_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
