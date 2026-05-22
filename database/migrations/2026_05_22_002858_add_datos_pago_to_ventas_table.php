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
        Schema::table('ventas', function (Blueprint $table) {
            $table->string('metodo_pago')->nullable()->after('total');
            $table->string('referencia_pago')->nullable()->index()->after('metodo_pago');
            $table->string('codigo_pago')->nullable()->index()->after('referencia_pago');
            $table->dateTime('fecha_limite_pago')->nullable()->after('codigo_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            $table->dropColumn([
                'metodo_pago',
                'referencia_pago',
                'codigo_pago',
                'fecha_limite_pago',
            ]);
        });
    }
};
