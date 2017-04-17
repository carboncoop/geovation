<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOsBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('os_buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('WKT', 2127);
            $table->string('fid', 20);
            $table->integer('featureCod');
            $table->integer('version');
            $table->string('versionDat', 10);
            $table->string('theme', 13);
            $table->decimal('calculated', 19, 15);
            $table->string('changeDate', 47);
            $table->string('reasonForC', 51);
            $table->string('descriptiv', 14);
            $table->string('descript_1', 11);
            $table->string('make', 7);
            $table->integer('physicalLe');
            $table->decimal('ext_peri', 34, 15);
            
            $table->index('fid');

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
