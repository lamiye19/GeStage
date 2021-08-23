<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = ["titreStage", "theme", "debut", "fin", "demande_id", "maitre_id", "service_id"];
    
    public function demande(){
        return $this->belongsTo(Demande::class);
    }

    public function maitre(){
        return $this->belongsTo(Maitre::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }
}
