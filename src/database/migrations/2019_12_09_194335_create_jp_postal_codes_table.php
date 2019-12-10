<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJpPostalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jp_postal_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('first_code')->index();
            $table->unsignedInteger('last_code')->index();
            $table->string('prefecture');
            $table->string('city');
            $table->string('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jp_postal_codes');
    }
}
