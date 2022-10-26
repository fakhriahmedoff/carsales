<?php

use App\Enums\CarFuelEnum;
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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('model_id')->references('id')->on('models')->cascadeOnDelete();
            $table->string('code_no');
            $table->string('grade');
            $table->string('shape');
            $table->integer('year');
            $table->string('mileage');
            $table->enum('fuel',[
                CarFuelEnum::PETROL,
                CarFuelEnum::DIESEL,
                CarFuelEnum::ELECTRIC,
                CarFuelEnum::GAS,
                CarFuelEnum::HYBRID,
                CarFuelEnum::PLUG_IN_HYBRID])->default(CarFuelEnum::PETROL);
            $table->string('engine');
            $table->string('drive_train');
            $table->string('length');
            $table->string('height');
            $table->string('net_weight');
            $table->string('gross_weight');
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
        Schema::dropIfExists('cars');
    }
};
