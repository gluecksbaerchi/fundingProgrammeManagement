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
            $table->text('link')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('actual_id')->nullable();
            $table->string('changes')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('actual_id')->references('id')->on('funding_programmes')->onDelete('cascade');
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
