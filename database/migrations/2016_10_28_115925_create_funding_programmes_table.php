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
            $table->unsignedInteger('contact_id')->nullable();
            $table->string('name');
            $table->string('organisation');
            $table->string('target_what')->nullable();
            $table->text('target_what_description')->nullable();
            $table->text('target_who')->nullable();
            $table->text('funding_sum')->nullable();
            $table->text('application')->nullable();
            $table->dateTime('runtime_from')->nullable();
            $table->dateTime('runtime_to')->nullable();
            $table->string('link')->nullable();
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
