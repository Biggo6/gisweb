<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaterqualitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waterqualities', function (Blueprint $table) {
            $table->increments('id');
			$table->string('monitoring_station');
			$table->string('labid')->nullable();
			$table->string('sampling_date');
			$table->string('temperature')->nullable();
			$table->string('pH')->nullable();
			$table->string('ec')->nullable();
			$table->string('tds')->nullable();
			$table->string('orp')->nullable();
			$table->string('wdo')->nullable();
			$table->string('nh3_n')->nullable();
			$table->string('turbidity')->nullable();
			$table->string('salinity')->nullable();
			$table->string('so42')->nullable();
			$table->string('tss')->nullable();
			$table->string('no3')->nullable();
			$table->string('cl')->nullable();
			$table->string('tc')->nullable();
			$table->string('fc')->nullable();
			$table->string('cod')->nullable();
			$table->string('bod')->nullable();
			$table->string('color')->nullable();
			$table->string('total_alkalinity')->nullable();
			$table->string('total_hardness')->nullable();
			$table->string('calcium')->nullable();
			$table->string('magnesium')->nullable();
			$table->string('iron')->nullable();
			$table->string('ortho')->nullable();
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
        Schema::dropIfExists('waterqualities');
    }
}
