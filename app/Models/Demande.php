<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = ["specialite",
     "p1", "p2", "p3", "pDate1", "pDate2", "pDate3", "pTitre1", "pTitre2", "pTitre3",
     "exp1", "exp2", "exp3", "expDate1", "expDate2", "expDate3", "expTitre1", "expTitre2", "expTitre3", 
     "hobbies", "stagiaire_id", "competences", "langues"
    ];

    public function stagiaire(){
        return $this->belongsTo(Stagiaire::class);
    }
}
