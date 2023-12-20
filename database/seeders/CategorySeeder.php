<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id' => Str::uuid(), 'name' => 'Technology', 'slug' => Str::slug('Technology')],
            ['id' => Str::uuid(), 'name' => 'Science', 'slug' => Str::slug('Science')],
            ['id' => Str::uuid(), 'name' => 'Business', 'slug' => Str::slug('Business')],
        ];

        Category::query()->insert($categories);

    }
}
