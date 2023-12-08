<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run()
    {
        $reports = [
            [
                'post_id'   => '3',
                'user_id'   => '5',
                'reason'    => 'Breaking the rules',
            ],
            [
                'post_id' => '6',
                'user_id' => '2',
                'reason'    => 'Breaking the rules',
            ],
        ];

        foreach ($reports as $report) {
            $this->db->table('reports')->insert($report);
        }
    }
}
