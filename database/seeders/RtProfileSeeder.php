<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RtProfile;

class RtProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RtProfile::create([
            'name' => 'RT 01',
            'description' => 'Deskripsi RT 01',
            'history' => 'Sejarah RT 01',
            'address' => 'Jl. Contoh No. 1',
            'map_embed' => '<iframe src="https://maps.app.goo.gl/tQtd6YRKBH9Tb6q66"></iframe>',
            'phone' => '08123456789',
            'email' => 'rt01@example.com',
        ]);

        RtProfile::create([
            'name' => 'RT 02',
            'description' => 'Deskripsi RT 02',
            'history' => 'Sejarah RT 02',
            'address' => 'Jl. Contoh No. 2',
            'map_embed' => '<iframe src="https://maps.google.com/..."></iframe>',
            'phone' => '08123456780',
            'email' => 'rt02@example.com',
        ]);

        // Tambahkan data lainnya sesuai kebutuhan
    }
}