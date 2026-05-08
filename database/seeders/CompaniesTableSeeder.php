<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('companies')->insert([
            [
                'company_name' => 'コカ・コーラ',
            ],
            [
                'company_name' => '伊藤園',
            ],
            [
                'company_name' => 'サントリー',
            ],
            [
                'company_name' => 'キリン',
            ],
        ]);
    }
}