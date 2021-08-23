<?php

namespace Database\Seeders;

use App\Models\Demande;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DemandeTableSeeder::class);
        //Demande::factory(2)->create();
    
        //Service::factory(2)->create();

    }
}
