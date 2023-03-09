<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Seeder;

class CategoryProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Categories

        $catBrand = Category::create([
            'title' => ['en' => 'Brand identity', 'it' => 'Identità aziendale'],
            'slug' => 'brand'
        ]);
        $catDigital = Category::create([
            'title' => ['en' => 'Digital design', 'it' => 'Progettazione digitale'],
            'slug' => 'digital'
        ]);
        $catIndustrial = Category::create([
            'title' => ['en' => 'Industrial design', 'it' => 'Design industriale'],
            'slug' => 'industrial'
        ]);

        // Projects

        Project::factory()->create([
            'title' => ['en' => 'Identity project', 'it' => 'Progetto di identità'],
            'category_id' => $catBrand->id,
            'is_published' => true,
        ])->addMedia(resource_path() . '/seederimages/p1.jpg')->preservingOriginal()->toMediaCollection();

        Project::factory()->create([
            'title' => ['en' => 'Second identity project', 'it' => 'Secondo progetto di identità'],
            'category_id' => $catBrand->id,
            'is_published' => true,
        ])->addMedia(resource_path() . '/seederimages/p2.jpg')->preservingOriginal()->toMediaCollection();

        Project::factory()->create([
            'title' => ['en' => 'Digital project', 'it' => 'Progetto digitale'],
            'category_id' => $catDigital->id,
            'is_published' => true,
        ])->addMedia(resource_path() . '/seederimages/p3.jpg')->preservingOriginal()->toMediaCollection();

        Project::factory()->create([
            'title' => ['en' => 'Industrial project', 'it' => 'Progetto industriale'],
            'category_id' => $catIndustrial->id,
            'is_published' => true,
        ])->addMedia(resource_path() . '/seederimages/p4.jpg')->preservingOriginal()->toMediaCollection();
    }
}
