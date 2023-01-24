<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionDesignTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('section_design_types')->insert(
            [
                'id'=>1,
                'name'=>"Text Image Card",
            ]
        );
        DB::table('section_design_types')->insert(
            [
                'id'=>2,
                'name'=>"Publication",
            ]
        );
        DB::table('section_design_types')->insert(
            [
                'id'=>3,
                'name'=>"Contribution",
            ]
        );
        DB::table('section_design_types')->insert(
            [
                'id'=>4,
                'name'=>"Half Parallax",
            ]
        );
        DB::table('section_design_types')->insert(
            [
                'id'=>5,
                'name'=>"Full Parallax",
            ]
        );
        DB::table('section_design_types')->insert(
            [
                'id'=>6,
                'name'=>"Events",
            ]
        );
        DB::table('section_design_types')->insert(
            [
                'id'=>7,
                'name'=>"Board Members",
            ]
        );
        DB::table('section_design_types')->insert(
            [
                'id'=>8,
                'name'=>"Executive Members",
            ]
        );
        DB::table('section_design_types')->insert(
            [
                'id'=>9,
                'name'=>"Gallery",
            ]
        );
    }
}
