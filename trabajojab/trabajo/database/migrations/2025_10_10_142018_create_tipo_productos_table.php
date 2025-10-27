<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tipo_productos', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('nombre');
            $table->string('categoria')->nullable(); // comestible o licor
            $table->string('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipo_productos');
    }
};

