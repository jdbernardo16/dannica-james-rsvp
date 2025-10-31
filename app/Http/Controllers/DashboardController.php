<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Guest;
use App\Models\Rsvp;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Get statistics
        $totalGroups = Group::count();
        $totalGuests = Guest::count();
        $totalRsvps = Rsvp::count();
        $attendingCount = Rsvp::attending()->sum('attending_count');

        // Get recent RSVPs
        $recentRsvps = Rsvp::with('group')
            ->latestSubmitted()
            ->limit(5)
            ->get()
            ->map(function ($rsvp) {
                // Transform the RSVP data to include group information as direct properties
                $rsvp->group_name = $rsvp->group ? $rsvp->group->name : null;
                $rsvp->max_attendees = $rsvp->group ? $rsvp->group->max_attendees : null;
                return $rsvp;
            });

        // Get groups with RSVP status
        $groupsWithRsvp = Group::with(['guests'])
            ->get()
            ->map(function ($group) {
                return [
                    'id' => $group->id,
                    'name' => $group->name,
                    'guest_count' => $group->guest_count,
                    'max_attendees' => $group->max_attendees,
                    'has_rsvp' => $group->hasRsvp(),
                    'is_attending' => $group->isAttending(),
                    'attending_count' => $group->attending_count,
                ];
            });

        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'totalGroups' => $totalGroups,
                'totalGuests' => $totalGuests,
                'totalRsvps' => $totalRsvps,
                'totalAttending' => $attendingCount,
            ],
            'recentRsvps' => $recentRsvps->map(function ($rsvp) {
                return [
                    'id' => $rsvp->id,
                    'group_name' => $rsvp->group->name,
                    'email' => $rsvp->email,
                    'attending_count' => $rsvp->attending_count,
                    'submitted_at' => $rsvp->submitted_at->toISOString(),
                ];
            }),
            'groupsWithRsvp' => $groupsWithRsvp->map(function ($group) {
                return [
                    'id' => $group['id'],
                    'name' => $group['name'],
                    'guest_count' => $group['guest_count'],
                    'max_attendees' => $group['max_attendees'],
                    'has_rsvp' => $group['has_rsvp'],
                ];
            }),
        ]);
    }
}
