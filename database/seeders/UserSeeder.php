<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
            'id_number' => '12314',
            'dept_id' => '2',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'rule_id' => 1,
            ],
            [
            'id_number' => '312312',
            'dept_id' => '2',
            'name' => 'Patient',
            'email' => 'patient@gmail.com',
            'password' => bcrypt('patient123'),
            'rule_id' => 2,
            ],
            [
            'id_number' => '312312',
            'dept_id' => '2',
            'name' => 'Patient2',
            'email' => 'patient2@gmail.com',
            'password' => bcrypt('patient123'),
            'rule_id' => 2,
            ],
            [
            'id_number' => '312312',
            'dept_id' => '2',
            'name' => 'Patient3',
            'email' => 'patient3@gmail.com',
            'password' => bcrypt('patient123'),
            'rule_id' => 2,
            ],
            [
            'id_number' => '312312',
            'dept_id' => '2',
            'name' => 'Patient4',
            'email' => 'patient4@gmail.com',
            'password' => bcrypt('patient123'),
            'rule_id' => 2,
            ],
        ];

        User::insert($user);
    }
}
