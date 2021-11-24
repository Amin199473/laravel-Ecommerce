<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title')->default('Laravel Shopping');
            $table->string('site_description')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->text('copy_right');
            $table->string('whatsapp')->nullable();
            $table->string('youTube')->nullable();
            $table->string('telegram')->nullable();
            $table->string('tweeter')->nullable();
            $table->string('instagram')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
