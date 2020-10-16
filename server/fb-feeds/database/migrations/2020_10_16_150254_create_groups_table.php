<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->boolean('parsing')->default(false);
            $table->boolean('active')->default(true);
            $table->boolean('public');
            $table->string('name')->unique();
            $table->string('url');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->timestamp('last_time_parsed_at')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
