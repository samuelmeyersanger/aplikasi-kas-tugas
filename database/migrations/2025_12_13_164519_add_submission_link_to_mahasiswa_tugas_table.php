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
    Schema::table('mahasiswa_tugas', function (Blueprint $table) {
        $table->string('submission_link')->nullable()->after('file_path');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa_tugas', function (Blueprint $table) {
            //
        });
    }
};
