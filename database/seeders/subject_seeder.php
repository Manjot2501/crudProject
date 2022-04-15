<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class subject_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subject')->insert([
            'title'=> 'Subject '.Str::random(1),
            'chapter' => json_encode([
                ['name'=> 'Chapter '.Str::random(1)],
                ['name'=> 'Chapter '.Str::random(1)],
                ['name'=> 'Chapter '.Str::random(1)],
                ['name'=> 'Chapter '.Str::random(1)],
                ['name'=> 'Chapter '.Str::random(1)],
                ['name'=> 'Chapter '.Str::random(1)],
            ]),
            'created_at'=>date('Y-m-d h:i:s'),
            'updated_at'=>date('Y-m-d h:i:s'),
        ]);
    }
}
