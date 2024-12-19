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
            'name' => 'RT 04',
            'description' => 'RT 04 adalah RT yang berada di kawasan perumahan Jl. Anggaran',
            'history' => 'RT 04 sudah berdiri sejak tahun 1990',
            'address' => 'Jl. Anggaran No. 1, Tangerang',
            'map_embed' => '<iframe src="https://maps.app.goo.gl/tQtd6YRKBH9Tb6q66"></iframe>',
            'phone' => '081234567890',
            'email' => 'rt04@gmail.com',
        ]);
        // Tambahkan data lainnya sesuai kebutuhan
    }
}