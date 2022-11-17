<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enregistrement extends Model
{
    use HasFactory;
    protected $fillable = [
        'numOrdre','dateEnregistrement','car_id','driver','km','numBon','responsable','montant'
    ];

    public function car(){
        return $this->BelongsTo(Car::class);
      }
}
