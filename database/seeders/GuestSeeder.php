<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\Group;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all groups
        $familyGroup = Group::where('name', 'Family')->first();
        $friendsGroup = Group::where('name', 'Friends')->first();
        $colleaguesGroup = Group::where('name', 'Colleagues')->first();
        $relativesGroup = Group::where('name', 'Relatives')->first();
        $neighborsGroup = Group::where('name', 'Neighbors')->first();

        $guests = [
            // Family guests
            [
                'group_id' => $familyGroup->id,
                'full_name' => 'John Smith',
                'email' => 'john.smith@example.com',
            ],
            [
                'group_id' => $familyGroup->id,
                'full_name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
            ],
            [
                'group_id' => $familyGroup->id,
                'full_name' => 'Michael Smith',
                'email' => null,
            ],
            [
                'group_id' => $familyGroup->id,
                'full_name' => 'Sarah Smith',
                'email' => null,
            ],
            [
                'group_id' => $familyGroup->id,
                'full_name' => 'Emily Smith',
                'email' => null,
            ],

            // Friends guests
            [
                'group_id' => $friendsGroup->id,
                'full_name' => 'Robert Johnson',
                'email' => 'robert.j@example.com',
            ],
            [
                'group_id' => $friendsGroup->id,
                'full_name' => 'Lisa Johnson',
                'email' => 'lisa.j@example.com',
            ],
            [
                'group_id' => $friendsGroup->id,
                'full_name' => 'David Wilson',
                'email' => 'david.w@example.com',
            ],
            [
                'group_id' => $friendsGroup->id,
                'full_name' => 'Amanda Wilson',
                'email' => null,
            ],

            // Colleagues guests
            [
                'group_id' => $colleaguesGroup->id,
                'full_name' => 'James Brown',
                'email' => 'james.brown@company.com',
            ],
            [
                'group_id' => $colleaguesGroup->id,
                'full_name' => 'Jennifer Davis',
                'email' => 'jennifer.d@company.com',
            ],
            [
                'group_id' => $colleaguesGroup->id,
                'full_name' => 'William Miller',
                'email' => 'william.m@company.com',
            ],

            // Relatives guests
            [
                'group_id' => $relativesGroup->id,
                'full_name' => 'Richard Anderson',
                'email' => 'richard.a@example.com',
            ],
            [
                'group_id' => $relativesGroup->id,
                'full_name' => 'Patricia Anderson',
                'email' => 'patricia.a@example.com',
            ],
            [
                'group_id' => $relativesGroup->id,
                'full_name' => 'Charles Anderson',
                'email' => null,
            ],
            [
                'group_id' => $relativesGroup->id,
                'full_name' => 'Barbara Anderson',
                'email' => null,
            ],
            [
                'group_id' => $relativesGroup->id,
                'full_name' => 'Thomas Anderson',
                'email' => null,
            ],
            [
                'group_id' => $relativesGroup->id,
                'full_name' => 'Nancy Anderson',
                'email' => null,
            ],

            // Neighbors guests
            [
                'group_id' => $neighborsGroup->id,
                'full_name' => 'Christopher Taylor',
                'email' => 'chris.taylor@example.com',
            ],
            [
                'group_id' => $neighborsGroup->id,
                'full_name' => 'Linda Taylor',
                'email' => null,
            ],
        ];

        foreach ($guests as $guest) {
            Guest::create($guest);
        }
    }
}
