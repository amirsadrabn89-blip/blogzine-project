<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // foreach(range(1 , 100) as $index){

        //     DB::table('posts')->insert([
        //         'post_code'    => 'cd-'.$index.time() ,
        //         'title'        => 'Tilte'."-".$index ,
        //         'image'        => 'no image' , 
        //         'user_id'      => $index.time() ,
        //         'published_at' => now(),
        //         'is_draft'     => 1 ,
        //     ]);
        // }


                                // normale  /|\
        // <<<---------------------------------------------------->>>
                                // by faker \|/


        // foreach(range(1 , 100) as $index){
        //     DB::table('posts')->insert([
        //         'post_code' => 'cd-'.$index.time(),
        //         'title' => fake()->sentence(3),
        //         'image' => fake()->imageUrl($width = 640, $height = 480),
        //         'user_id' => $index.time(),
        //         'published_at' => now(),
        //         'is_draft' => fake()->boolean(),
        //     ]);
        // }
    }   
}
