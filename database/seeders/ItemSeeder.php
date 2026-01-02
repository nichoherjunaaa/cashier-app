<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['item_code' => 'MKN-001', 'name' => 'Roma Malkist 200g', 'category_id' => 1, 'stock' => 18, 'price' => 7000,],
            ['item_code' => 'MKN-002', 'name' => 'Taro Net Seaweed', 'category_id' => 1, 'stock' => 22, 'price' => 9000,],
            ['item_code' => 'MKN-003', 'name' => 'SilverQueen 65g', 'category_id' => 1, 'stock' => 15, 'price' => 13000,],
            ['item_code' => 'MKN-004', 'name' => 'Chitato BBQ', 'category_id' => 1, 'stock' => 20, 'price' => 10000],
            ['item_code' => 'MKN-005', 'name' => 'SilverQueen 100g', 'category_id' => 1, 'stock' => 15, 'price' => 7000],
            ['item_code' => 'MKN-006', 'name' => 'Roma Kelapa', 'category_id' => 1, 'stock' => 18, 'price' => 6500],
            ['item_code' => 'MKN-007', 'name' => 'Taro Net Original', 'category_id' => 1, 'stock' => 22, 'price' => 9000],
            ['item_code' => 'MKN-008', 'name' => 'BengBeng', 'category_id' => 1, 'stock' => 25, 'price' => 5000],
            ['item_code' => 'MKN-009', 'name' => 'Chiki Balls', 'category_id' => 1, 'stock' => 15, 'price' => 7000],
            ['item_code' => 'MKN-010', 'name' => 'KitKat 45g', 'category_id' => 1, 'stock' => 25, 'price' => 5000],
            ['item_code' => 'MKN-011', 'name' => 'SilverQueen Almond', 'category_id' => 1, 'stock' => 10, 'price' => 15000],
            ['item_code' => 'MKN-012', 'name' => 'Tango Wafer', 'category_id' => 1, 'stock' => 30, 'price' => 6500],
            ['item_code' => 'MKN-013', 'name' => 'Twistko', 'category_id' => 1, 'stock' => 28, 'price' => 8000],

            ['item_code' => 'MIN-001', 'name' => 'Teh Pucuk Harum 350ml', 'category_id' => 2, 'stock' => 25, 'price' => 4500,],
            ['item_code' => 'MIN-002', 'name' => 'Coca Cola 390ml', 'category_id' => 2, 'stock' => 20, 'price' => 6000,],
            ['item_code' => 'MIN-003', 'name' => 'Ultra Milk Coklat 250ml', 'category_id' => 2, 'stock' => 18, 'price' => 6500,],
            ['item_code' => 'MIN-004', 'name' => 'Fanta 390ml', 'category_id' => 2, 'stock' => 20, 'price' => 6000],
            ['item_code' => 'MIN-005', 'name' => 'Sprite 390ml', 'category_id' => 2, 'stock' => 18, 'price' => 6000],
            ['item_code' => 'MIN-006', 'name' => 'Cleo 600ml', 'category_id' => 2, 'stock' => 30, 'price' => 5000],
            ['item_code' => 'MIN-007', 'name' => 'Teh Kotak Sosro', 'category_id' => 2, 'stock' => 25, 'price' => 4500],
            ['item_code' => 'MIN-008', 'name' => 'Ultra Milk Coklat 200ml', 'category_id' => 2, 'stock' => 20, 'price' => 5000],
            ['item_code' => 'MIN-009', 'name' => 'Teh Botol Sosro', 'category_id' => 2, 'stock' => 20, 'price' => 5000],
            ['item_code' => 'MIN-010', 'name' => 'Nescafe Latte', 'category_id' => 2, 'stock' => 18, 'price' => 12000],
            ['item_code' => 'MIN-011', 'name' => 'Good Day Cappuccino', 'category_id' => 2, 'stock' => 15, 'price' => 10000],
            ['item_code' => 'MIN-012', 'name' => 'Cappucino ABC', 'category_id' => 2, 'stock' => 12, 'price' => 11000],
            ['item_code' => 'MIN-013', 'name' => 'Le Minerale 600ml', 'category_id' => 2, 'stock' => 30, 'price' => 5000],

            ['item_code' => 'ATK-001', 'name' => 'Buku Tulis Sidu 38 Lembar', 'category_id' => 3, 'stock' => 30, 'price' => 4500,],
            ['item_code' => 'ATK-002', 'name' => 'Penghapus Joyko', 'category_id' => 3, 'stock' => 40, 'price' => 2000,],
            ['item_code' => 'ATK-003', 'name' => 'Spidol Snowman Hitam', 'category_id' => 3, 'stock' => 12, 'price' => 8500],
            ['item_code' => 'ATK-004', 'name' => 'Pensil 2B', 'category_id' => 3, 'stock' => 50, 'price' => 2000],
            ['item_code' => 'ATK-005', 'name' => 'Pulpen Gel Hitam', 'category_id' => 3, 'stock' => 30, 'price' => 3500],
            ['item_code' => 'ATK-006', 'name' => 'Penggaris 30cm', 'category_id' => 3, 'stock' => 40, 'price' => 5000],
            ['item_code' => 'ATK-007', 'name' => 'Buku Tulis 50 Lembar', 'category_id' => 3, 'stock' => 35, 'price' => 5000],
            ['item_code' => 'ATK-008', 'name' => 'Spidol Merah', 'category_id' => 3, 'stock' => 20, 'price' => 8000],
            ['item_code' => 'ATK-009', 'name' => 'Buku Gambar 50 Lembar', 'category_id' => 3, 'stock' => 20, 'price' => 12000],
            ['item_code' => 'ATK-010', 'name' => 'Stapler Kecil', 'category_id' => 3, 'stock' => 15, 'price' => 10000],
            ['item_code' => 'ATK-011', 'name' => 'Refill Pulpen', 'category_id' => 3, 'stock' => 50, 'price' => 3000],
            ['item_code' => 'ATK-012', 'name' => 'Sticky Notes', 'category_id' => 3, 'stock' => 25, 'price' => 7000],
            ['item_code' => 'ATK-013', 'name' => 'Map Plastik', 'category_id' => 3, 'stock' => 30, 'price' => 5000],

        ];
        foreach ($items as $item) {

            Item::updateOrCreate(
                ['item_code' => $item['item_code']],
                [
                    'name' => $item['name'],
                    'category_id' => $item['category_id'],
                    'stock' => $item['stock'],
                    'price' => $item['price'],
                ]
            );
        }
    }
}
