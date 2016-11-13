<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('street')->nullable();
            $table->string('street_nr')->nullable();
            $table->string('zip_code', 6)->nullable();
            $table->string('city')->nullable();
            $table->string('tel')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('internet')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
