<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Data extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('variant');
            $table->integer('amountOfData');
            $table->double('min');
            $table->double('max');
            $table->boolean('intOrReal');
            $table->boolean('normalDistribution');
            $table->integer('stdDeviation');

            $table->boolean('frequencies');
            $table->boolean('relativeFrequencies');
            $table->boolean('average');
            $table->boolean('fashion');
            $table->boolean('median');
            $table->boolean('dispersion');
            $table->boolean('standardDeviation');
            $table->boolean('coefficientOfVariation');
            $table->boolean('decileCoefficient');
            $table->boolean('lowerQuartile');
            $table->boolean('upperQuartile');
            $table->boolean('levelQuantileP');
            $table->integer('levelP');
            $table->boolean('confidenceIntervalWithGammaReliability');
            $table->boolean('histogram');
            $table->boolean('cumulata');

            $table->text('sample');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
