<?php

namespace Database\Seeders;

use App\Models\CollegeDepartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollegeDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $department_name = [
                [
                'department_name' => 'CAS',
                ],
                [
                'department_name' => 'CIT',
                ],
                [
                'department_name' => 'CTE',
                ],
                [
                'department_name' => 'CBA',
                ],
                [
                'department_name' => 'CAFF',
                ],
                [
                'department_name' => 'CCJE',
                ],
            ];

            CollegeDepartment::insert($department_name);
    }
}
