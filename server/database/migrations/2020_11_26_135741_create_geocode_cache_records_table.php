<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeocodeCacheRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geocode_cache_records', function (Blueprint $table) {
            $table->id();
            $table->text('request');
            $table->decimal('lat', 8, 2);
            $table->decimal('long', 8, 2);
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('area')->nullable();
            $table->string('locality')->nullable();
            $table->string('district')->nullable();
            $table->string('metro')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('entrance')->nullable();
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
        Schema::dropIfExists('geocode_cache_records');
    }
}
