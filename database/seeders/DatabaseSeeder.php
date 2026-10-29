<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Menyuruh Laravel untuk memanggil AnggotaSeeder yang berisi data 15 minggu
        $this->call([
            AnggotaSeeder::class,
        ]);
    }
}
