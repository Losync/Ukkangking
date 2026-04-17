<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Kue Basah
            ['name' => 'Bolu Kukus Pandan', 'category' => 'Kue Basah', 'price' => 15000, 'stock' => 50, 'description' => 'Bolu kukus lembut dengan aroma pandan yang harum dan warna hijau alami.'],
            ['name' => 'Kue Lapis Legit', 'category' => 'Kue Basah', 'price' => 85000, 'stock' => 20, 'description' => 'Kue lapis legit premium dengan lapisan tipis yang lembut dan rasa mentega yang kaya.'],
            ['name' => 'Dadar Gulung', 'category' => 'Kue Basah', 'price' => 12000, 'stock' => 40, 'description' => 'Dadar gulung isi kelapa parut dan gula merah yang manis dan gurih.'],
            ['name' => 'Klepon', 'category' => 'Kue Basah', 'price' => 10000, 'stock' => 60, 'description' => 'Klepon tradisional dengan isian gula merah cair dan taburan kelapa parut.'],

            // Kue Kering
            ['name' => 'Nastar Keju', 'category' => 'Kue Kering', 'price' => 45000, 'stock' => 30, 'description' => 'Nastar premium dengan selai nanas homemade dan topping keju yang gurih.'],
            ['name' => 'Kastengel', 'category' => 'Kue Kering', 'price' => 50000, 'stock' => 25, 'description' => 'Kastengel renyah dengan keju edam pilihan yang lumer di mulut.'],
            ['name' => 'Putri Salju', 'category' => 'Kue Kering', 'price' => 40000, 'stock' => 35, 'description' => 'Putri salju lembut bertaburan gula halus, meleleh di lidah.'],
            ['name' => 'Lidah Kucing', 'category' => 'Kue Kering', 'price' => 38000, 'stock' => 40, 'description' => 'Lidah kucing tipis dan renyah dengan rasa butter yang authentic.'],

            // Roti
            ['name' => 'Roti Coklat Lava', 'category' => 'Roti', 'price' => 18000, 'stock' => 45, 'description' => 'Roti empuk dengan isian coklat lava yang meleleh saat digigit.'],
            ['name' => 'Roti Sobek Keju', 'category' => 'Roti', 'price' => 25000, 'stock' => 30, 'description' => 'Roti sobek lembut dengan keju mozarella yang melimpah.'],
            ['name' => 'Roti Gandum', 'category' => 'Roti', 'price' => 22000, 'stock' => 35, 'description' => 'Roti gandum sehat dan bergizi, cocok untuk sarapan sehari-hari.'],

            // Kue Ulang Tahun
            ['name' => 'Black Forest Cake', 'category' => 'Kue Ulang Tahun', 'price' => 185000, 'stock' => 10, 'description' => 'Kue black forest klasik dengan lapisan coklat, krim, dan cherry yang mewah.'],
            ['name' => 'Red Velvet Cake', 'category' => 'Kue Ulang Tahun', 'price' => 195000, 'stock' => 8, 'description' => 'Kue red velvet dengan cream cheese frosting yang lembut dan elegan.'],
            ['name' => 'Tiramisu Cake', 'category' => 'Kue Ulang Tahun', 'price' => 210000, 'stock' => 6, 'description' => 'Tiramisu cake premium dengan kopi espresso Italia dan mascarpone cheese.'],

            // Pastry
            ['name' => 'Croissant Butter', 'category' => 'Pastry', 'price' => 20000, 'stock' => 30, 'description' => 'Croissant renyah berlapis dengan butter premium Perancis.'],
            ['name' => 'Danish Pastry', 'category' => 'Pastry', 'price' => 22000, 'stock' => 25, 'description' => 'Danish pastry klasik dengan isian custard cream dan buah-buahan segar.'],
            ['name' => 'Eclair Coklat', 'category' => 'Pastry', 'price' => 18000, 'stock' => 35, 'description' => 'Eclair renyah berisi vla vanilla dan lapisan coklat ganache premium.'],
        ];

        foreach ($products as $item) {
            $category = Category::where('name', $item['category'])->first();
            if ($category) {
                Product::create([
                    'name' => $item['name'],
                    'slug' => Str::slug($item['name']),
                    'category_id' => $category->id,
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'description' => $item['description'],
                    'is_active' => true,
                ]);
            }
        }
    }
}
