<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            // birthday, gender, mobile, personal_id,
            //job, address, intro, nick_name, favorite_1, favorite_2, favorite_3, blood_type, university, high_school, graduate_year
           // $table->integer('id')->autoIncrement();
            $table->date('birthday');
            $table->tinyInteger('gender');
            $table->string('mobile')->unique();
            $table->string('personal_id')->unique();
            
            //thoong tin ko bat buoc
            $table->string('job')->nullable();
            $table->string('adress')->nullable();
            $table->string('intro')->nullable();
            $table->string('nick_name')->nullable();
            $table->string('favorite_1')->nullable();
            $table->string('favorite_2')->nullable();
            $table->string('favorite_3')->nullable();
            $table->integer('blood_type')->nullable();
            $table->string('university')->nullable();
            $table->string('high_school')->nullable();
            $table->integer('graduate_year')->nullable();
            $table->integer('delete_at')->default(0);
            
            
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
            //
        });
    }
}
