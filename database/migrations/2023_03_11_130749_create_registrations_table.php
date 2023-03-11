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
        if (!Schema::hasTable('registrations')) {
            Schema::create('registrations', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('vaccine_center_id');
                $table->string('email')->unique();
                $table->string('mobile');
                $table->date('date');
                $table->string('status');
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('vaccine_center_id')->references('id')->on('vaccine_centers')->onDelete('cascade');

            });
        }

        Schema::table('registrations', function (Blueprint $table) {
            $table->dropForeign('registrations_user_id_foreign');
            $table->dropForeign('registrations_vaccine_center_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
