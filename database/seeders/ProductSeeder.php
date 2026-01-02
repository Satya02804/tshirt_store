<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // I have fixed the URLs and removed the manual 'id' (database handles it automatically)
        $tshirts = [
            [
                'name' => "Thar Roxx T-Shirt",
                'url' => "https://chriscross.in/cdn/shop/files/MahindraTharRoxxgreentshirt.jpg?v=1747661046&width=1000",
                'price' => 799
            ],
            [
                'name' => "Yamaha RD350 - The Original Superbike T-Shirt",
                'url' => "https://chriscross.in/cdn/shop/files/ChrisCrossYamahaRD350blackcottontshirt.jpg?v=1740994644&width=1000",
                'price' => 799
            ],
            [
                'name' => "Yamaha RD 350 Torque Induction Bikers T-Shirt",
                'url' => "https://chriscross.in/cdn/shop/files/YamahaRD350bluetshirt_b18d3a40-8d58-4db5-b08b-36cab421fdf0.jpg?v=1740994650&width=1000",
                'price' => 899
            ],
            [
                'name' => "Himalayan Spirit",
                'url' => "https://chriscross.in/cdn/shop/files/RoyalEnfieldHimalayan450Tshirtblackcotton.jpg?v=1740994031&width=1000",
                'price' => 799
            ],
            [
                'name' => "Suzuki Jimny T-Shirt",
                'url' => "https://chriscross.in/cdn/shop/files/SuzukiJimnyTshirtBeigecottontshirtmens.jpg?v=1745402090&width=1000",
                'price' => 849
            ],
            [
                'name' => "Yamaha RX100 T-Shirt",
                'url' => "https://chriscross.in/cdn/shop/files/YamahaRX100ChrisCrossCottonTshirtBlack.jpg?v=1740994062&width=1000",
                'price' => 749
            ],
            [
                'name' => "Classic Mercedes Benz T Shirt",
                'url' => "https://chriscross.in/cdn/shop/files/ChrisCrossMercedesBenzClassic90stshirt.jpg?v=1740994620&width=1000",
                'price' => 699
            ],
            [
                'name' => "Suzuki Jimny Oversized T-Shirt",
                'url' => "https://chriscross.in/cdn/shop/files/JimnyOversizedT-shirtNavyblue.jpg?v=1748928220&width=600",
                'price' => 1299
            ]
        ];

        foreach ($tshirts as $tshirt) {
            Product::create($tshirt);
        }
        // $this->call(ProductSeeder::class);
    }
}
