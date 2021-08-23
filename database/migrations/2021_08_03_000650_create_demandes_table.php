<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('specialite');
            $table->string('expDate1');
            $table->string('expDate2');
            $table->string('expDate3');
            $table->string('expTitre1');
            $table->string('expTitre2');
            $table->string('expTitre3');
            $table->string('exp1');
            $table->string('exp2');
            $table->string('exp3');
            $table->string('pDate1');
            $table->string('pDate2');
            $table->string('pDate3');
            $table->string('pTitre1');
            $table->string('pTitre2');
            $table->string('pTitre3');
            $table->string('p1');
            $table->string('p2');
            $table->string('p3');
            $table->string('hobbies');
            $table->string('competences');
            $table->string('langues');
            $table->string('statut')->nullable();
            $table->timestamps();
            $table->foreignId('stagiaire_id')->constrained();
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
        Schema::table('maitres', function(Blueprint $table){
            $table->dropForeign('stagiaire_id');
        });

        Schema::dropIfExists('demandes');
    }
}
