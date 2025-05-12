<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'status' => 'draft',
        ]);
        Status::create([
            'status' => 'in review',
        ]);
        Status::create([
            'status' => 'reviewed',
        ]);
        Status::create([
            'status' => 'published',
        ]);
    }
}
