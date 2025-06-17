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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('toppings');
            $table->string('untable');
            $table->string('medida');
            $table->decimal('precio', 8, 2);
            $table->boolean('vendido')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
