<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOsHeightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('os_heights', function (Blueprint $table) {
            $table->increments('id');
            $table->string('OS_TOPO_TOID', 20);
            $table->integer('OS_TOPO_VERSION');
            $table->string('BHA_ProcessDate', 10);
            $table->string('TileRef', 6);
            $table->decimal('AbsHMin', 3,1);
            $table->string('AbsH2', 4);
            $table->string('AbsHMax', 4);
            $table->string('RelH2', 3);
            $table->string('RelHMax', 4);
            $table->decimal('BHA_Conf', 3,1);
            
            $table->index('OS_TOPO_TOID');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('os_buildings');
    }
}
