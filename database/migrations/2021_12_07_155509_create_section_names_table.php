<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_names', function (Blueprint $table) {
            $table->id();
            $table->string('title',191);
            $table->tinyInteger('title_align')->default(1)->comment('0=left,1=center,2=right');
            $table->unsignedInteger('position')->default(1000);
            $table->unsignedBigInteger('section_design_type_id')->nullable();
            $table->string('background_color')->nullable();
            $table->unsignedInteger('col')->default(4);
            $table->unsignedInteger('row')->default(1);
            $table->boolean('title_is_show')->default(true);
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
        Schema::dropIfExists('section_names');
    }
}
