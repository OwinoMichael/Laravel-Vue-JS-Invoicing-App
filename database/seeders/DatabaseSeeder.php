<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Products;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CounterSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(InvoiceSeeder::class);
        $this->call(InvoiceItemSeeder::class);

    }
}
