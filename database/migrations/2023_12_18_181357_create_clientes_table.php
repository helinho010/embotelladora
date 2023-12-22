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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('imagen',200)->comment("Este campo se utiliza para almacenar el nombre de la imagen");
            $table->string('latitud',50);
            $table->string('longitud',50);
            $table->string('nombre_ubicacion')->comment("");
            $table->dateTime('fecha', $precision = 0);
            $table->string("direccion")->comment("Direccion del punto a registrar");
            $table->string("numero_contacto",15);
            $table->text("nota",350)->comment("Un campo para que se pueda registrar alguna observacion, nota o alguna referencia del cliente");
            
            $table->unsignedBigInteger('id_grupo')->comment("identificador con el cual se relaciona la tabla grupos y la de clientes");
            $table->foreign('id_grupo')->references('id')->on('grupos')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
