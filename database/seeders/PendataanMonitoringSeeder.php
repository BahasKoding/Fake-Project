<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pendataan;
use App\Models\Monitoring;
use Carbon\Carbon;

class PendataanMonitoringSeeder extends Seeder
{
    public function run()
    {
        // Membuat 50 data Pendataan
        Pendataan::factory()->count(25)->create()->each(function ($pendataan) {
            // Untuk setiap Pendataan, buat 1-3 data Monitoring
            $monitoringCount = rand(1, 3);
            for ($i = 0; $i < $monitoringCount; $i++) {
                Monitoring::create([
                    'id_pendataan' => $pendataan->id,
                    'Jumlah_bantuan' => rand(100000, 1000000),
                    'created_at' => Carbon::now()->subDays(rand(1, 60))->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
        });
    }
}
