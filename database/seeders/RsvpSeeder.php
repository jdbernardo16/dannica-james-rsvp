<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Rsvp;
use Illuminate\Database\Seeder;

class RsvpSeeder extends Seeder
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

        $rsvps = [
            // Family RSVP - Attending
            [
                'group_id' => $familyGroup->id,
                'attending_count' => 5,
                'message' => 'We are so excited to celebrate with you! Looking forward to the special day.',
                'song_suggestion' => 'Perfect - Ed Sheeran',
                'email' => 'john.smith@example.com',
                'submitted_at' => now()->subDays(10),
            ],

            // Friends RSVP - Attending
            [
                'group_id' => $friendsGroup->id,
                'attending_count' => 3,
                'message' => 'Count us in! Can\'t wait for the celebration.',
                'song_suggestion' => 'Thinking Out Loud - Ed Sheeran',
                'email' => 'robert.j@example.com',
                'submitted_at' => now()->subDays(8),
            ],

            // Colleagues RSVP - Not attending
            [
                'group_id' => $colleaguesGroup->id,
                'attending_count' => 0,
                'message' => 'Sorry we won\'t be able to make it. Have a wonderful celebration!',
                'song_suggestion' => null,
                'email' => 'jennifer.d@company.com',
                'submitted_at' => now()->subDays(5),
            ],

            // Relatives RSVP - Attending
            [
                'group_id' => $relativesGroup->id,
                'attending_count' => 4,
                'message' => 'The whole family is coming! So happy for you both.',
                'song_suggestion' => 'Can\'t Help Falling in Love - Elvis Presley',
                'email' => 'richard.a@example.com',
                'submitted_at' => now()->subDays(3),
            ],

            // Neighbors RSVP - Not submitted yet (this will be used for testing)
        ];

        foreach ($rsvps as $rsvp) {
            Rsvp::create($rsvp);
        }
    }
}
