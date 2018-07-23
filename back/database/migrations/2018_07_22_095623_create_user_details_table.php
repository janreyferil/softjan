<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->integer('user_detail_id')->unsigned();
            $table->primary('user_detail_id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->integer('subject_id')->unsigned()->index();
            $table->foreign('subject_id')->references('subject_id')->on('subjects');
            $table->string('first_name',50)->nullable();
            $table->string('last_name',50)->nullable();
            $table->integer('age')->nullable();
            $table->string('address',255)->nullable();
            $table->string('contact',25)->nullable()->unique();
            $table->date('birthday')->nullable();
            $table->string('status',25)->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
