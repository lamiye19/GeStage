<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ["nom", "prenom", "sexe", "dateNais", "adr", "tel", "email", "ecole"];

    public function demande(){
        return $this->hasOne(Demande::class);
    }

    public function renouveller(){
        return $this->hasMany(Renouveller::class);
    }

    
}
