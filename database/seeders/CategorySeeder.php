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
            ['name' => 'Pakaian', 'code_prefix' => 'PKN'],
            ['name' => 'Elektronik', 'code_prefix' => 'ELK'],
            ['name' => 'Aksesoris', 'code_prefix' => 'AKS'],
            ['name' => 'Lainya', 'code_prefix' => 'BRG'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']], // kondisi pencarian
                ['code_prefix' => $category['code_prefix']] // data yang di-update
            );
        }
    }
}
