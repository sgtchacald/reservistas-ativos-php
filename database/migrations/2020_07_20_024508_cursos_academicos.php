<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CursosAcademicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CURSOSACADEMICOS', function (Blueprint $table) {
            $table->bigIncrements('idcursoacademico');
            $table->string('cacnome', 100);
             //Informações Segurança 
             $table->timestamps();
             $table->timestamp('dtinativacao')->nullable();
             $table->bigInteger('usucriou')->nullable();
             $table->bigInteger('usueditou')->nullable();
             $table->bigInteger('usuexcluiu')->nullable();
            $table->char('cacindstatus', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CURSOSACADEMICOS');
    }
}
