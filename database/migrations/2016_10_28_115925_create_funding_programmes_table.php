<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundingProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funding_programmes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('contact_id');
            $table->string('name');
            $table->string('organisation');
            $table->string('target_what');
            $table->text('target_what_description');
            $table->text('target_who');
            $table->text('funding_sum');
            $table->text('application');
            $table->dateTime('runtime_from');
            $table->dateTime('runtime_to');
            $table->string('link');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funding_programmes');
    }
}
