<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundRaisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_raisers', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(2); // 2- Running, 1- Done
            $table->string('title');
            $table->double('targeted_fund');
            $table->bigInteger('collected_fund')->default(0);
            $table->integer('people_donated')->default(0);
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->integer('position')->nullable()->default(1000);
            $table->boolean('featured')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_tags')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('media_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('fund_raisers');
    }
}
