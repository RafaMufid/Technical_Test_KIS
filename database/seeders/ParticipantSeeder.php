<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Participant;
use Illuminate\Support\Str;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Participant::create([
        'id' => '7dd9cdc1-6183-4178-a687-3c5861b58532',
        'nama' => 'Rafa Mufid',
        'pin' => null,
        ]);

        Participant::create([
        'id' => 'f1e2c3d4-5678-90ab-cdef-1234567890ab',
        'nama' => 'John Doe',
        'pin' => null,
        ]);
    }
}
