<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_types', function (Blueprint $table) {
            $table->id();
            $table->integer('position')->default(1000);
            $table->unsignedBigInteger('event_id')->nullable();
            $table->string('name')->nullable();
            $table->double('amount')->default(0);
            $table->boolean('is_free')->default(false);
            $table->json('attributes')->nullable();
            $table->boolean('is_limit')->default(false);
            $table->integer('limit')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('join_types');
    }
}
