<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
            'status_name' => 'Pending',
            ],
            [
            'status_name' => 'Complied',
            ],
            [
            'status_name' => 'In Stock',
            ],
            [
            'status_name' => 'Out of Stock',
            ],
            [
            'status_name' => 'Declined',
            ],
        ];

        Status::insert($status);
    }
}
