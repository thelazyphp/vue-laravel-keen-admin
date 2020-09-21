<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('image_id')->nullable();
            $table->boolean('active')->default(true);
            $table->string('role')->default('admin');
            $table->string('f_name');
            $table->string('m_name')->nullable();
            $table->string('l_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('email_verified_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
