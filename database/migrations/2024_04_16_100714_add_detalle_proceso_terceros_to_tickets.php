<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetalleProcesoTercerosToTickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('detalle_proceso_terceros')->nullable();
            $table->string('detalle_finalizado')->nullable();
            $table->timestamp('finalizado_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('detalle_proceso_terceros');
            $table->dropColumn('detalle_finalizado');
            $table->dropColumn('finalizado_at');
        });
    }
}
