<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Social;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $images = Storage::allFiles('image');
        foreach($images as $image){

            Image::factory()->create([
                'file' => $image,
                'dimension' => Image::getDimension($image)
            ]);
        }

        User::find([2, 4, 6])->each(function($user){
            $user->social()->save(Social::factory()->make());
        });
    }
}
