<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYandexGeocodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yandex_geocodes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('request')->unique();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('area')->nullable();
            $table->string('locality')->nullable();
            $table->string('district')->nullable();
            $table->string('metro')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('entrance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yandex_geocodes');
    }
}
