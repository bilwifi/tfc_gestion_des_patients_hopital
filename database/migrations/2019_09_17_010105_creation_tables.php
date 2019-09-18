<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiches', function (Blueprint $table) {
            $table->bigIncrements('idfiches');
            $table->string('nom');
            $table->string('postnom');
            $table->string('prenom');
            $table->string('num_fiche');
            // $table->timestamps();
        });
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('idservices');
            $table->string('lib');
            
        });
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('pseudo')->unique();
            $table->string('password');
            $table->unsignedBigInteger('idservices');
            $table->timestamps();
            $table->foreign('idservices')
                  ->references('idservices')->on('services')->onDelete('cascade');
        });
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('idpatients');
            $table->unsignedBigInteger('idfiches');
            $table->unsignedBigInteger('idservices');
            $table->enum('statut',['en_attente','en_cours','terminer'])->default('en_attente');
            $table->timestamps();
            $table->foreign('idfiches')
                  ->references('idfiches')->on('fiches')->onDelete('cascade');
            $table->foreign('idservices')
                  ->references('idservices')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
        Schema::dropIfExists('users');
        Schema::dropIfExists('services');
        Schema::dropIfExists('fiches');
        
    }
}
