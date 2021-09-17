<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rdv extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = ["dateHeure", "demande_id"];

    public function demande(){
        return $this->belongsTo(Demande::class);
    }
}
