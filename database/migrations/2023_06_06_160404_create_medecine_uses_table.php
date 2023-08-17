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
        Schema::create('medecine_uses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('used_id');
            $table->unsignedBigInteger('medecine_id');
            $table->bigInteger('qty')->nullable();

            $table->foreign('used_id')->references('id')->on('request_checkups');
            $table->foreign('medecine_id')->references('id')->on('medecine_inventories');
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
        Schema::dropIfExists('medecine_uses');
    }
};
