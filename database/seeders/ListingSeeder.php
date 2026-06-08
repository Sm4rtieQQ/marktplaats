<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Listing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        Listing::factory(20)->create()->each(function ($listing) use ($categories) {
            $listing->categories()->attach($categories->random(rand(1, 5))->pluck('id'));
        });
    }
}
