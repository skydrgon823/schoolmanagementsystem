<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_temps', function (Blueprint $table) {
            $table->id();
            $table->integer('adm_no');
            $table->integer('form'); // 1,2,3,4
            $table->string('stream');  
            $table->string('name');
            $table->string('email');
            $table->string('code');
            $table->string('photo');
            $table->string('user_type');
            $table->string('password');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }
        
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_temps');
    }
}
