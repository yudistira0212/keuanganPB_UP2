<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create(
            [
                'name' => 'Akmal',
                'email' => 'akmal@gmail.com',
                'password' => '12345678',
                'role' => 'superuser',
            ]

        );
        \App\Models\User::factory()->create(
            [
                'name' => 'Akmal',
                'email' => 'akmal2@gmail.com',
                'password' => '12345678',
                'role' => 'keuangan',
            ]

        );
        \App\Models\User::factory()->create(
            [
                'name' => 'Akmal',
                'email' => 'akmal3@gmail.com',
                'password' => '12345678',
                'role' => 'dinas',
            ]

        );
        // Seeder untuk Skpd
        DB::table('skpds')->insert([
            [
                "dinas" => "DINAS KESEHATAN",
                "alamat" => "Amban Permai, Manokwari, Papua Barat",
                "kode_pos" => 98323,
                "user_id" => 3
            ],
            [
                "dinas" => "DINAS PERHUBUNGAN",
                "alamat" => "Arfai, Manokwari, Papua Barat",
                "kode_pos" => 98323,
                "user_id" => 3
            ],
            [
                "dinas" => "DINAS PENDIDIKAN",
                "alamat" => "SOWI 2, Manokwari, Papua Barat",
                "kode_pos" => 98323,
                "user_id" => 3
            ],
            [
                "dinas" => "DINAS KEARSIPAN",
                "alamat" => "Arfai, Manokwari, Papua Barat",
                "kode_pos" => 98323,
                "user_id" => 3
            ],
        ]);

        // Seeder untuk Ttd
        DB::table('ttds')->insert([
            [
                "nama" => "Akmal",
                "url_ttd" => "Amban Permai, Manokwari, Papua Barat",
                "nip" => 122454
            ],
            [
                "nama" => "Yesaya",
                "url_ttd" => "Arfai, Manokwari, Papua Barat",
                "nip" => 123456
            ],
            [
                "nama" => "DINAS PENDIDIKAN",
                "url_ttd" => "SOWI 2, Manokwari, Papua Barat",
                "nip" => 12345
            ],
            [
                "nama" => "Abang Hadi",
                "url_ttd" => "Arfai, Manokwari, Papua Barat",
                "nip" => 2893304
            ],
        ]);
    }
}
