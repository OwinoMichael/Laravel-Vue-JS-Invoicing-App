<?php

namespace Database\Seeders;

use App\Models\InvoiceItem;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceItemSeeder extends Seeder
{
    use TruncateTable;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->truncate('invoice_items');
        $invoiceItems = InvoiceItem::factory(10)->create();

    }
}
