<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRfidScanLogsTable extends Migration
{
    public function up()
    {
        Schema::create('rfid_scan_logs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('rfid_tag')->nullable();
            $table->enum('role', ['receptionist', 'doctor'])->default('receptionist');
            $table->enum('status', ['waiting', 'done'])->default('waiting');
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('rfid_scan_logs');
    }
}
