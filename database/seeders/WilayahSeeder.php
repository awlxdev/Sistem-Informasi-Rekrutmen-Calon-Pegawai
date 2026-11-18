<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class WilayahSeeder extends Seeder
{
    public function run(): void
    {
        $provinceFile = database_path('data/wilayah/provinces.csv');
        $regencyFile = database_path('data/wilayah/regencies.csv');

        if (!is_file($provinceFile) || !is_file($regencyFile)) {
            throw new RuntimeException('File CSV wilayah Indonesia tidak ditemukan.');
        }

        DB::transaction(function () use ($provinceFile, $regencyFile) {
            $now = now();

            $provinces = array_map(
                'str_getcsv',
                file($provinceFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)
            );

            $provinceHeader = array_map('trim', array_shift($provinces));
            $provinceHeader[0] = preg_replace('/^\xEF\xBB\xBF/', '', $provinceHeader[0]);

            $provinceRows = [];

            foreach ($provinces as $row) {
                $data = array_combine($provinceHeader, $row);

                $provinceRows[] = [
                    'id' => (int) $data['id'],
                    'name' => trim($data['name']),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            foreach (array_chunk($provinceRows, 100) as $chunk) {
                DB::table('provinces')->upsert(
                    $chunk,
                    ['id'],
                    ['name', 'updated_at']
                );
            }

            $regencies = array_map(
                'str_getcsv',
                file($regencyFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)
            );

            $regencyHeader = array_map('trim', array_shift($regencies));
            $regencyHeader[0] = preg_replace('/^\xEF\xBB\xBF/', '', $regencyHeader[0]);

            $regencyRows = [];

            foreach ($regencies as $row) {
                $data = array_combine($regencyHeader, $row);

                $regencyRows[] = [
                    'id' => (int) $data['id'],
                    'province_id' => (int) $data['province_id'],
                    'name' => trim($data['name']),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            foreach (array_chunk($regencyRows, 100) as $chunk) {
                DB::table('regencies')->upsert(
                    $chunk,
                    ['id'],
                    ['province_id', 'name', 'updated_at']
                );
            }
        });

        $this->command->info('Data wilayah Indonesia berhasil diimpor.');
        $this->command->info('Provinsi: ' . DB::table('provinces')->count());
        $this->command->info('Kabupaten/Kota: ' . DB::table('regencies')->count());
    }
}