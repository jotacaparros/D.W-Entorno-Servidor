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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();

            $table->string('numero', 10);
            $table->date('dd, mm, YY');
            $table->decimal('base', 19,2);
            $table->decimal('importeiva', 19,2);
            $table->decimal('importe', 19,2);

            $table->unsignedBigInteger('id_cliente')->nullable();
           
            $table->foreign('id_cliente')
                    ->references('id')->on('clientes')
                    ->onDelete('set null');

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
        Schema::dropIfExists('facturas');
    }
};
