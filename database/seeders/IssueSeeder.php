<?php

namespace Database\Seeders;

use App\Models\Issue;
use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    public function run()
    {
        $issues = [
            [
                'title' => 'Issue 1: AI Advancements',
                'issue_date' => '2023-10-01',
                'status' => 'published',
            ],
            [
                'title' => 'Issue 2: IoT Innovations',
                'issue_date' => '2023-11-01',
                'status' => 'published',
            ],
            [
                'title' => 'Issue 3: Cybersecurity Trends',
                'issue_date' => '2023-12-01',
                'status' => 'unpublished',
            ],
            [
                'title' => 'Issue 4: AI',
                'issue_date' => '2023-10-01',
                'status' => 'published',
            ],
            [
                'title' => 'Issue 5: IoT ',
                'issue_date' => '2023-11-01',
                'status' => 'published',
            ],
            [
                'title' => 'Issue 6: Cybersecurity ',
                'issue_date' => '2023-12-01',
                'status' => 'unpublished',
            ],
        ];

        foreach ($issues as $issue) {
            Issue::create($issue);
        }
    }
}