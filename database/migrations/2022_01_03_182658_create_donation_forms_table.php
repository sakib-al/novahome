<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_forms', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('image',100)->nullable();
            $table->json('f_of_payment')->nullable();
            $table->json('default_amounts')->nullable();
            $table->json('fields')->nullable();
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->text('meta_tags')->nullable();
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
        Schema::dropIfExists('donation_forms');
    }
}
