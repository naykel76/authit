<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (config('authit.split_name_fields')) {
                $table->dropColumn('name');
                $table->string('first_name', 128)->nullable()->after('id');
                $table->string('last_name', 128)->nullable()->after('first_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'first_name')) {
                $table->dropColumn(['first_name', 'last_name']);
                $table->string('name')->nullable()->after('id');
            }
        });
    }
};
