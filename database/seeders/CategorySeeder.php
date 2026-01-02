<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Minuman', 'code_prefix' => 'MIN'],
            ['name' => 'Makanan', 'code_prefix' => 'MKN'],
            ['name' => 'Alat Tulis Kantor', 'code_prefix' => 'ATK'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']], // kondisi pencarian
                ['code_prefix' => $category['code_prefix']] // data yang di-update
            );
        }
    }
}
