<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renouveler extends Model
{
    use HasFactory;
    
    protected $fillable = ["demande_id", "stagiaire_id"];

    public function demande(){
        return $this->belongsTo(Demande::class);
    }

    public function stagiaire(){
        return $this->belongsTo(Stagiaire::class);
    }
}
