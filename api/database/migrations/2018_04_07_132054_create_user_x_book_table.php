<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserXBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_x_book', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('users_id');
            $table->integer('book_id');
            $table->dateTime('rent_time')->comment('借出时间');
            $table->dateTime('return_time')->comment('应当归还时间');
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
        Schema::dropIfExists('user_x_book');
    }
}
