<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_centers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name')->nullable();
            $table->string('ar_name')->nullable();
            $table->string('en_name')->nullable();

            $table->unsignedBigInteger('parent_id')->index()->nullable();
            $table->foreign('parent_id')->references('id')->on('cost_centers')
                ->onUpdate('CASCADE');

            $table->softDeletes();
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
        Schema::dropIfExists('cost_centers');
    }
}
