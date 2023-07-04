<?php

namespace Database\Seeders;

use App\Models\jenismakanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenismakananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        jenismakanan::create([
            'jenismakanan' => 'Makanan',
        ]);
        jenismakanan::create([
            'jenismakanan' => 'Minuman',
        ]);
    }
}
