<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('school_name')->nullable();
            $table->string('school_short_name')->nullable();
            $table->string('school_email', 100)->unique()->nullable();
            $table->string('school_phone')->nullable();
            $table->unsignedInteger('school_head_id')->nullable();
            $table->unsignedInteger('school_title_id')->nullable();
            $table->unsignedInteger('school_hod_id')->nullable();
            $table->string('school_postal')->nullable();
            $table->unsignedInteger('school_gender_id')->nullable();
            $table->unsignedInteger('school_status_id')->nullable();
            $table->string('school_logo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            //

        });
    }
}
