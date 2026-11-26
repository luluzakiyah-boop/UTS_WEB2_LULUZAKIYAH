<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@lupatisserie.test'], [
            'name' => 'Lulu Zakiyah',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        $categories = collect([
            ['Birthday Cake', 'Kue ulang tahun manis untuk momen spesial.', 'categories/birthday-cake.jpg'],
            ['Cupcake', 'Cupcake lembut dalam ukuran personal yang cantik.', 'categories/cupcake.jpg'],
            ['Cookies', 'Cookies renyah dengan rasa yang hangat dan lezat.', 'categories/cookies.jpg'],
            ['Pastry', 'Pastry fresh dengan lapisan ringan dan buttery.', 'categories/pastry.jpg'],
        ])->mapWithKeys(function ($item) {
            $category = Category::updateOrCreate(['slug' => Str::slug($item[0])], [
                'name' => $item[0],
                'description' => $item[1],
                'image' => $item[2],
            ]);

            return [$item[0] => $category];
        });

        $products = [
            ['Strawberry Dream Cake', 'Birthday Cake', 325000, 'Cake lembut dengan krim strawberry segar dan dekorasi pastel yang elegan.', true, 'products/strawberry-dream-cake.jpg'],
            ['Pink Velvet Cake', 'Birthday Cake', 285000, 'Pink velvet cake lembut dengan cream cheese frosting dan sentuhan vanilla.', true, 'products/pink-velvet-cake.jpg'],
            ['Chocolate Bliss Cake', 'Birthday Cake', 295000, 'Cake cokelat rich dengan lapisan ganache dan taburan cokelat premium.', false, 'products/chocolate-bliss-cake.jpg'],
            ['Pastel Vanilla Cupcake', 'Cupcake', 35000, 'Cupcake vanilla lembut dengan buttercream pastel dan hiasan cantik.', true, 'products/pastel-vanilla-cupcake.jpg'],
            ['Strawberry Cupcake', 'Cupcake', 38000, 'Cupcake strawberry harum dengan topping krim dan buah segar.', true, 'products/strawberry-cupcake.jpg'],
            ['Butter Cookies', 'Cookies', 65000, 'Cookies mentega klasik yang renyah, lembut di dalam, dan penuh rasa.', false, 'products/butter-cookies.jpg'],
            ['Choco Chip Cookies', 'Cookies', 70000, 'Cookies cokelat chip premium dengan potongan cokelat melimpah.', true, 'products/choco-chip-cookies.jpg'],
            ['Almond Croissant', 'Pastry', 48000, 'Croissant butter renyah dengan isian almond manis dan taburan almond.', false, 'products/almond-croissant.jpg'],
        ];

        foreach ($products as $index => $product) {
            Product::updateOrCreate(['slug' => Str::slug($product[0])], [
                'category_id' => $categories[$product[1]]->id,
                'name' => $product[0],
                'description' => $product[3],
                'price' => $product[2],
                'is_featured' => $product[4],
                'is_available' => true,
                'image' => $product[5],
            ]);
        }

        foreach ([
            ['Alya Putri', 'Mahasiswi', 'Kuenya cantik, rasanya tidak terlalu manis, dan selalu sukses membuat acara lebih istimewa.', 5],
            ['Nadia Rahma', 'Ibu Rumah Tangga', 'Pesanan tepat waktu dan hasilnya persis seperti yang saya bayangkan. Sangat recommended!', 5],
            ['Salsa Amelia', 'Pengusaha', 'Cupcake dan cookiesnya enak sekali. Kemasan juga rapi dan cocok untuk hadiah.', 5],
        ] as $testimonial) {
            Testimonial::updateOrCreate(['name' => $testimonial[0]], [
                'profession' => $testimonial[1],
                'message' => $testimonial[2],
                'rating' => $testimonial[3],
                'is_active' => true,
            ]);
        }
    }
}
