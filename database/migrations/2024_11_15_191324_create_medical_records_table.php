<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('patient_id')->nullable(); // Reference to Patients (no FK constraint)
            $table->unsignedBigInteger('doctor_id')->nullable(); // Reference to Users (Doctor)
            $table->unsignedBigInteger('receptionist_id')->nullable(); // Reference to Users (Receptionist)
            $table->enum('status', ['scheduled', 'completed'])->default('scheduled'); // Status (e.g., Scheduled, Completed)
            $table->decimal('weight', 5, 2)->nullable(); // Weight (in kg)
            $table->integer('height')->nullable(); // Height (in cm)
            $table->integer('oxygen_level')->nullable(); // Oxygen Level (percentage)
            $table->string('blood_pressure')->nullable(); // Blood Pressure (e.g., "120/80")
            $table->decimal('body_temperature', 5, 2)->nullable(); // Body Temperature (e.g., 36.5)
            $table->text('reason_for_visit')->nullable(); // Reason for Visit
            $table->text('diagnose')->nullable(); // Diagnosis
            $table->text('prescription')->nullable(); // Prescription
            $table->text('allergy')->nullable(); // Allergies
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
        Schema::dropIfExists('medical_records');
    }
}
