<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // HAPUS kolom bawaan Laravel
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }

            // pastikan kolom ini ADA (kalau belum)
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->after('id');
            }

            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'pengguna'])->default('pengguna');
            }

            if (!Schema::hasColumn('users', 'nama')) {
                $table->string('nama')->after('password');
            }

            if (!Schema::hasColumn('users', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable();
            }

            if (!Schema::hasColumn('users', 'jenis_kelamin')) {
                $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            }

            if (!Schema::hasColumn('users', 'no_hp')) {
                $table->string('no_hp')->nullable();
            }

            if (!Schema::hasColumn('users', 'alamat')) {
                $table->text('alamat')->nullable();
            }

            if (!Schema::hasColumn('users', 'foto')) {
                $table->string('foto')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable();
        });
    }
};
