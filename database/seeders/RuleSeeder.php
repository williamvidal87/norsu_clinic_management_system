<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rule = [
            [
            'rule_name' => 'Admin',
            ],
            [
            'rule_name' => 'Patient',
            ],
        ];

        Rule::insert($rule);
    }
}
