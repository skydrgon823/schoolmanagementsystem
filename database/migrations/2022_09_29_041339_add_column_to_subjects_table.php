<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subjects', function (Blueprint $table) {
            //
            $table->integer('out_x');
            $table->integer('out_y');
            $table->integer('out_z');
            $table->integer('con_x');
            $table->integer('con_y');
            $table->integer('con_z');
            $table->boolean('status_x');
            $table->boolean('status_y');
            $table->boolean('status_z');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            //
            $table->dropColumn('out_x');
            $table->dropColumn('out_y');
            $table->dropColumn('out_z');
            $table->dropColumn('con_x');
            $table->dropColumn('con_y');
            $table->dropColumn('con_z');
            $table->dropColumn('status_x');
            $table->dropColumn('status_y');
            $table->dropColumn('status_z');
        });
    }
}
