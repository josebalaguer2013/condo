<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perfiles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('sexo')->nullable();
    $table->date('fecha_nacimiento')->nullable();
    $table->string('estado_civil')->nullable();
    $table->string('nivel_instruccion')->nullable();
    $table->integer('carga_familiar')->default(0);
    $table->string('profesion')->nullable();
    $table->string('lugar_labora')->nullable();
    $table->string('condicion_laboral')->nullable();
    $table->string('estatus_laboral')->nullable();
    $table->string('centro_votacion')->nullable();
    $table->boolean('tiene_discapacidad')->default(0);
    $table->text('condicion_salud')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfiles');
    }
};
