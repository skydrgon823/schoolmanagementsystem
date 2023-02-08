<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBomPaRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bom_pa_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('code', 100)->nullable()->unique();
            $table->string('emp_date')->nullable();
            $table->integer('group_id');
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
        Schema::dropIfExists('bom_pa_records');
    }
}
