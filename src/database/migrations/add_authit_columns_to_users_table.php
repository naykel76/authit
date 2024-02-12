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
                $table->string('firstname', 128)->nullable()->after('id');
                $table->string('lastname', 128)->nullable()->after('firstname');
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
                if (Schema::hasColumn('users', 'firstname')) {
                    $table->dropColumn('firstname');
                }
                if (Schema::hasColumn('users', 'lastname')) {
                    $table->dropColumn('lastname');
                }
                if (!Schema::hasColumn('users', 'name')) {
                    $table->string('name', 255)->nullable()->after('id');
                }
            }
        });
    }
};
