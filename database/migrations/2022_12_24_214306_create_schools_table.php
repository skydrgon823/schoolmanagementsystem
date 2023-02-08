<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('phone')->nullable();
            $table->unsignedInteger('head_id')->nullable();
            $table->unsignedInteger('title_id')->nullable();
            $table->unsignedInteger('hod_id')->nullable();
            $table->string('postal')->nullable();
            $table->unsignedInteger('gender_id')->nullable();
            $table->unsignedInteger('status_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
}
