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
            $table->bigIncrements('id');
            $table->string('username', 50);
            $table->string('password', 255);
            $table->unsignedInteger('role_id');
            $table->string('truename', 50)->default('');
            $table->string('email', 50)->default('');
            $table->string('phone', 60)->default('');
            $table->enum('sex',['先生','女士'])->default('先生');
            $table->char('last_ip', 15)->default('');
            $table->timestamps();
            $table->softDeletes();
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
