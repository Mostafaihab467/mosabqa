<?php

namespace Database\Seeders;

use App\Models\Lookup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LookupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'question_timer',
                'value' => '10',
            ],
            [
                'name' => 'success_percentage',
                'value' => '50',
            ],
            [
                'name' => 'exam_start_date',
                'value' => '2024-04-20 00:00:00',
            ],
            [
                'name' => 'exam_end_date',
                'value' => '2024-04-20 23:59:59',
            ]
        ];
        Lookup::insert($data);
    }
}
