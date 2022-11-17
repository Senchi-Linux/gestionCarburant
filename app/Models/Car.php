<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'immatriculation',
        'etat',
    ];
  
    public function records(){
        return $this->hasMany(Enregistrement::class);
    }
}
