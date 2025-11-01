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
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('tempat_lahir')->nullable()->after('jenis_kelamin');
        $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['tempat_lahir', 'tanggal_lahir']);
    });
}

};
