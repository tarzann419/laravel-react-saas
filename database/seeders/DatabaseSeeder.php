<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Packages;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Dan',
            'email' => 'dan@dev.com',
            'password' => bcrypt('password'),
        ]);

        Feature::create([
            'image' => 'https://e7.pngegg.com/pngimages/965/871/png-clipart-assorted-color-stamps-rubber-stamp-postage-stamps-stationery-ink-printing-rubber-stamp-animals-label-thumbnail.png',
            'route_name' => 'feature1.index',
            'name' => 'Calaculate Sum',
            'description' => 'Calculate the sum of two numbers',
            'required_credits' => 1,
            'active' => true,
        ]);
        
        Feature::create([
            'image' => 'https://image.similarpng.com/very-thumbnail/2021/01/Approved-stamp-on-transparent-PNG.png',
            'route_name' => 'feature2.index',
            'name' => 'Calaculate Difference',
            'description' => 'Calculate the difference of two numbers',
            'required_credits' => 3,
            'active' => true,
        ]);

        Packages::create([
            'name' => 'Basic',
            'price' => 5,
            'credits' => 20,
        ]);

        Packages::create([
            'name' => 'Silver',
            'price' => 20,
            'credits' => 100,
        ]);

        Packages::create([
            'name' => 'Gold',
            'price' => 50,
            'credits' => 500,
        ]);
    }
}
