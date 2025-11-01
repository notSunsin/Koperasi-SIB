<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pinjamans', function (Blueprint $table) {
            if (!Schema::hasColumn('pinjamans', 'uraian')) {
                $table->string('uraian')->after('user_id');
            }

            if (!Schema::hasColumn('pinjamans', 'kredit')) {
                $table->decimal('kredit', 15, 2)->default(0)->after('uraian');
            }

            if (!Schema::hasColumn('pinjamans', 'saldo')) {
                $table->decimal('saldo', 15, 2)->default(0)->after('kredit');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pinjamans', function (Blueprint $table) {
            $table->dropColumn(['uraian', 'kredit', 'saldo']);
        });
    }
};
