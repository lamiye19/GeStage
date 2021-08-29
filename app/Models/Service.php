<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = ["lib", "directeur"];

    public function stage(){
        return $this->hasMany(Stage::class);
    }

}
