<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // 配套设施，房屋图片, 租赁方式， 租赁周期 多对多
        Schema::create('houses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->comment('房源名称');
            $table->string('area')->comment('小区名称');

            $table->unsignedInteger('region')->comment('行政区划代码');
            $table->string('addr');

            $table->unsignedTinyInteger('towards')->comment('朝向');
            $table->unsignedSmallInteger('building_area');
            $table->unsignedSmallInteger('available_area');

            $table->unsignedSmallInteger('built')->comment('建造于');
            $table->unsignedInteger('rpm')->comment('RMB 每月');
            $table->tinyInteger('floor');
            $table->unsignedTinyInteger('bedroom');
            $table->unsignedTinyInteger('hall');
            $table->unsignedTinyInteger('bathroom');


            $table->unsignedTinyInteger('position') -> comment('区域');
            

            


            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedInteger('houseowner');
            $table->text('desc');
            $table->text('info')->comment('房源信息');
            $table->unsignedInteger('housegroup')->default(0);
            $table->unsignedTinyInteger('recommend')->default(0);
            $table->decimal('long', 10, 7)->nullable()->comment('经度');
            $table->decimal('lat', 10, 7)->nullable()->comment('纬度');
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
        Schema::dropIfExists('houses');
    }
}
