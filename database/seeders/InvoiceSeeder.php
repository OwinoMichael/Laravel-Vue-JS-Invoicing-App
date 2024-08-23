<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $this->truncate('invoices');
       $invoices = Invoice::factory(10)->create();
    }
}
