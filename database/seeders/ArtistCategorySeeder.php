<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('artist_categories')->insert([
            [
                'title' => 'Music',
                'created_at'    => now()
            ],
            [
                'title' => 'Photography',
                'created_at'    => now()
            ],
        ]);
    }
}
