<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fund_raiser_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name',191)->nullable();
            $table->string('mobile_no',60)->nullable();
            $table->string('email',60)->nullable();
            $table->tinyInteger('payment_type')->default(1)->comment('1=one time, 2=others');
            $table->string('f_payment',191)->nullable();
            $table->string('t_duration',191)->nullable();
            $table->double('amount')->default(0);
            $table->string('payment_status',100)->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('donations');
    }
}
