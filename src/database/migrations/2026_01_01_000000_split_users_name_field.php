<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (! config('authit.use_single_name_field')) {
                $table->dropColumn('name');
                $table->string('first_name', 128)->nullable()->after('id');
                $table->string('last_name', 128)->nullable()->after('first_name');
            }
        });
    }
};
