<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_teams', function (Blueprint $table) {
            $table->id();
            $table->string('name',191);
            $table->string('image',191)->nullable();
            $table->string('image_path',191)->nullable();
            $table->unsignedBigInteger('media_id')->nullable();
            $table->string('designation',191)->nullable();
            $table->tinyInteger('member_type')->default(2)->comment('1=executive,2=general');
            $table->longText('description')->nullable();
            $table->integer('position')->default(1000);
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('our_teams');
    }
}
