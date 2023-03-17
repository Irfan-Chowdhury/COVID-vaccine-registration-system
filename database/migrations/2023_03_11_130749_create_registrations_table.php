<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vaccine_center_id');
            $table->string('nid')->unique();
            $table->string('name');
            $table->string('gender');
            $table->string('date_of_birth');
            $table->string('email');
            $table->string('mobile');
            $table->date('schedule_date');
            $table->string('status');
            $table->timestamps();

            $table->foreign('vaccine_center_id')->references('id')->on('vaccine_centers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropForeign('registrations_vaccine_center_id_foreign');
            $table->dropIfExists('registrations');
        });
    }
};













 // if (! Schema::hasTable('registrations')) {
        //     Schema::create('registrations', function (Blueprint $table) {
        //         $table->id();
        //         $table->unsignedBigInteger('vaccine_center_id');
        //         $table->string('nid')->unique();
        //         $table->string('name');
        //         $table->string('gender');
        //         $table->string('date_of_birth');
        //         $table->string('email');
        //         $table->string('mobile');
        //         $table->date('schedule_date');
        //         $table->string('status');
        //         $table->timestamps();

        //         $table->foreign('vaccine_center_id')->references('id')->on('vaccine_centers')->onDelete('cascade');
        //     });
        // }

        // Schema::table('registrations', function (Blueprint $table) {
        //     $table->dropForeign('registrations_vaccine_center_id_foreign');
        // });
