<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            [
                'name' => 'Family',
                'max_attendees' => 5,
            ],
            [
                'name' => 'Friends',
                'max_attendees' => 4,
            ],
            [
                'name' => 'Colleagues',
                'max_attendees' => 3,
            ],
            [
                'name' => 'Relatives',
                'max_attendees' => 6,
            ],
            [
                'name' => 'Neighbors',
                'max_attendees' => 2,
            ],
        ];

        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}
