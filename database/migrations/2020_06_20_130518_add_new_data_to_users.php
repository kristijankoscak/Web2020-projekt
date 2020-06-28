<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewDataToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('county')->default('Unset');
            $table->string('city')->default('Unset');
            $table->string('address')->default('Unset');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('county')->default('Unset');
            $table->dropColumn('city')->default('Unset');
            $table->dropColumn('address')->default('Unset');
        });
    }
}
