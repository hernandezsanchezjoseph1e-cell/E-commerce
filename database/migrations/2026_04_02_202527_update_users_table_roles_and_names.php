<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1 permitir temporalmente todos los valores
        DB::statement("
            ALTER TABLE users 
            MODIFY role ENUM('cliente','empleado','gerente','administrador') 
            NOT NULL DEFAULT 'cliente'
        ");

        // 2 actualizar roles existentes
        DB::table('users')
            ->where('role', 'empleado')
            ->update(['role' => 'gerente']);

        DB::table('users')
            ->where('role', 'gerente')
            ->update(['role' => 'administrador']);

        // 3 eliminar 'empleado' del ENUM final
        DB::statement("
            ALTER TABLE users 
            MODIFY role ENUM('cliente','gerente','administrador') 
            NOT NULL DEFAULT 'cliente'
        ");

        // 4 columnas nombre/apellidos si no existen
        Schema::table('users', function (Blueprint $table) {

            if (!Schema::hasColumn('users', 'nombre')) {
                $table->string('nombre')->nullable();
            }

            if (!Schema::hasColumn('users', 'apellidos')) {
                $table->string('apellidos')->nullable();
            }

        });
    }

    public function down(): void
    {
        // restaurar ENUM anterior
        DB::statement("
            ALTER TABLE users 
            MODIFY role ENUM('cliente','empleado','gerente') 
            NOT NULL DEFAULT 'cliente'
        ");

        Schema::table('users', function (Blueprint $table) {

            if (Schema::hasColumn('users', 'nombre')) {
                $table->dropColumn('nombre');
            }

            if (Schema::hasColumn('users', 'apellidos')) {
                $table->dropColumn('apellidos');
            }

        });
    }
};
