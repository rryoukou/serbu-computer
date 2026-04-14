<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Laptop', 'Aksesoris'];
        $category = fake()->randomElement($categories);

        if ($category === 'Laptop') {
            $name = fake()->randomElement([
                'MacBook Air M2', 'MacBook Pro 14"', 'ASUS ROG Zephyrus', 
                'Lenovo ThinkPad X1', 'Acer Nitro 5', 'HP Victus 15',
                'Dell XPS 13', 'MSI Katana GF66'
            ]) . ' ' . fake()->bothify('??-###');
            
            $specs = "RAM: " . fake()->randomElement(['8GB', '16GB', '32GB']) . " | Storage: " . fake()->randomElement(['256GB SSD', '512GB SSD', '1TB NVMe']) . " | CPU: " . fake()->randomElement(['Intel i7', 'AMD Ryzen 7', 'Apple M2']);
        } else {
            $name = fake()->randomElement([
                'Logitech G502 Mouse', 'Keychron K2 Keyboard', 'Samsung Odyssey G5 Monitor',
                'SteelSeries Arctis 7', 'Razer DeathAdder', 'TP-Link Archer Router',
                'Western Digital 1TB HDD', 'Corsair Vengeance 16GB RAM'
            ]);
            
            $specs = "Brand: " . fake()->randomElement(['Logitech', 'Razer', 'Samsung', 'Corsair', 'TP-Link']);
        }

        return [
            'name' => $name,
            'category' => $category,
            'specs' => $specs,
            'price' => fake()->randomFloat(2, 500000, 25000000), // Range 500rb - 25jt
            'stock' => fake()->numberBetween(0, 50),
            'details' => fake()->paragraph(),
            'purchase_guide' => "Pastikan stok ready sebelum checkout. Garansi resmi 1 tahun.",
            'photo' => null, // Placeholder saja
        ];
    }
}
