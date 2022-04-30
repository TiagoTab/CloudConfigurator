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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('ram');
            $table->integer('ram_size_gb');
            $table->enum('ram_type', array('ddr3', 'ddr4'));
            $table->string('hdd');
            $table->enum('hdd_type', array('sas', 'sata', 'ssd'));
            $table->integer('hdd_size_gb');
            $table->string('location');
            $table->string('price')->nullable();
            $table->boolean('is_available')->default(1);
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
        Schema::dropIfExists('servers');
    }
};
