<?php

namespace Database\Seeders;

use App\Models\BrochureDownload;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = fake('pt_PT');
        $downloads = [];

        for ($i = 0; $i < 30; $i++) {
            $downloads[] = [
                'nome' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'telefone' => str_pad((string) $faker->unique()->numberBetween(910000000, 969999999), 9, '0', STR_PAD_LEFT),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        BrochureDownload::insert($downloads);
    }
}
