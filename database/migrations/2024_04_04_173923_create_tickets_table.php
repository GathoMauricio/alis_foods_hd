<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('estatus_id');
            $table->bigInteger('sintoma_id');
            $table->bigInteger('autor_id');
            $table->bigInteger('tecnico_id')->nullable();
            $table->string('folio');
            $table->string('descripcion');
            $table->boolean('sla')->nullable();
            $table->timestamp('proceso_at')->nullable();
            $table->timestamp('cerrado_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('tickets');
    }
}
