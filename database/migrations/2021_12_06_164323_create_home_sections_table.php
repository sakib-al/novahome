<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_name',191)->nullable();
            $table->string('background_color',191)->nullable();
            $table->integer('col')->default(1);
            $table->integer('row')->default(3);
            $table->boolean('section_name_is_show')->default(false);
            $table->string('title',191);
            $table->string('sub_title',191)->nullable();
            $table->unsignedBigInteger('section_name_id')->nullable();
            $table->unsignedBigInteger('section_design_type_id')->nullable();
            $table->integer('position')->default(1000);
            $table->tinyInteger('text_align')->default(1)->comment('1=left,2=right');
            $table->boolean('is_image_inner_border')->default(false);
            $table->string('image',191)->nullable();
            $table->string('image_path',191)->nullable();
            $table->unsignedBigInteger('media_id')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('button_name',191)->nullable();
            $table->string('button_url',191)->nullable();
            $table->double('raised_amount')->nullable();
            $table->double('raised_percentage')->nullable();
            $table->tinyInteger('parallax_option')->nullable()->comment('1=vote,2=opinion');
            $table->boolean('status')->default(true);
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::dropIfExists('home_sections');
    }
}
