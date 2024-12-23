<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('rfid_tag')->unique(); // rfid_tag
            $table->string('name'); // Patient's Name
            $table->string('nim'); // NIM
            $table->string('telkomedika_number'); // Telkomedika Number
            $table->date('date_of_birth'); // Birth Date
            $table->enum('gender', ['m', 'f']); // Gender ('m' for male, 'f' for female)
            $table->timestamps(); // Created and Updated Timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
