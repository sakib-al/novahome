<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReunionInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reunion_inputs', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(1);
            $table->foreignId('reunion_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('type'); // Input, Option, Radio, Big Input
            $table->longText('options')->nullable(); // Json Data
            $table->integer('position')->default(1000);
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
        Schema::dropIfExists('reunion_inputs');
    }
}
