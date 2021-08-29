<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenouvellerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renouveller', function (Blueprint $table) {
            $table->id();
            $table->foreignId('demande_id')->constrained();
            $table->foreignId('stagiaire_id')->constrained();
            $table->timestamps();
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
        Schema::table('renouveller', function(Blueprint $table){
            $table->dropForeign('demande_id', 'stagiaire_id');
        });
        
        Schema::dropIfExists('renouveller');
    }
}
