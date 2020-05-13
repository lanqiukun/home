<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_owners', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->string('name', 50);
            $table->unsignedTinyInteger('sex');
            $table->unsignedTinyInteger('age') -> nullable();
            $table->char('phone', 20);
            $table->string('card', 20) -> nullable();
            $table->string('address', 100) -> nullable();
            $table->string('pic', 200) -> nullable();
            $table->string('email', 50) -> nullable();

            
            
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
        Schema::dropIfExists('house_owners');
    }
}
