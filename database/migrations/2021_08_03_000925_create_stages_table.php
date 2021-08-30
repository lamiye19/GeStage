<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->string('titreStage');
            $table->string('theme');
            $table->date('debut');
            $table->date('fin');
            $table->string('observation')->nullable();
            $table->string('renduDoc')->nullable();
            $table->boolean('etat')->nullable();
            $table->foreignId('demande_id')->constrained();
            $table->foreignId('maitre_id')->constrained();
            $table->foreignId('service_id')->constrained();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stages', function(Blueprint $table){
            $table->dropForeign('demande_id', 'maitre_id', 'service_id');
        });
        
        Schema::dropIfExists('stages');
    }
}
