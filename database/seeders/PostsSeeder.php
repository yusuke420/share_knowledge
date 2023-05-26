<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            [
                'title' => 'test1',
                'body' => 'test1',
                'importance' => 1,
                'user_id' => 1
            ],
            [
                'title' => 'test2',
                'body' => 'test2',
                'importance' => 2,
                'user_id' => 1
            ],
            [
                'title' => 'test3',
                'body' => 'test3',
                'importance' => 3,
                'user_id' => 1
            ]
        ]);
    }
}
