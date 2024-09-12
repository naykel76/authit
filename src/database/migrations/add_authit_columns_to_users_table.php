<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!config('authit.use_single_name_field')) {
                $table->dropColumn('name');
                $table->string('first_name', 128)->nullable()->after('id');
                $table->string('last_name', 128)->nullable()->after('first_name');
            }
            $table->string('avatar', 2048)->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'avatar')) {
                $table->dropColumn('avatar');
            }
            if (!config('authit.use_single_name_field')) {
                if (Schema::hasColumn('users', 'first_name')) {
                    $table->dropColumn('first_name');
                }
                if (Schema::hasColumn('users', 'last_name')) {
                    $table->dropColumn('last_name');
                }
                if (!Schema::hasColumn('users', 'name')) {
                    $table->string('name', 255)->nullable()->after('id');
                }
            }
        });
    }
};
