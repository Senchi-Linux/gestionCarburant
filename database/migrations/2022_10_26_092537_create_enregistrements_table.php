<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enregistrements', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('numOrdre')->unique();
            $table->date('dateEnregistrement');
            $table->foreignId('car_id')->constrained('vehicules')->onUpdate('cascade')->onDelete('cascade');
          //  $table->foreignId('driver_id')->constrained('conducteurs')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('driver');
            $table->bigInteger('km');
            $table->bigInteger('numBon');
            $table->text('responsable');
            $table->float('montant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enregistrements');
    }
};
