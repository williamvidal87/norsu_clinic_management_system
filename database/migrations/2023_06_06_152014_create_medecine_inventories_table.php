<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medecine_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('medecine_name');
            $table->bigInteger('qty')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();


            $table->foreign('status_id')->references('id')->on('statuses');
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
        Schema::dropIfExists('medecine_inventories');
    }
};
