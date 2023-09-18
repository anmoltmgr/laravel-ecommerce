<?php

namespace Database\Seeders;

use Database\Factories\admin\CategoryFactory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryFactory::new()->count(50)->create();
    }
}
