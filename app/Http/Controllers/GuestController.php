<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Group;
use App\Mail\RsvpInvitationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class GuestController extends Controller
{
    /**
     * Display a listing of the guests.
     */
    public function index(Request $request)
    {
        $query = Guest::with(['group']);

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by group
        if ($request->has('group_id') && $request->group_id && $request->group_id !== 'all') {
            $query->where('group_id', $request->group_id);
        }

        // Filter by email status
        if ($request->has('has_email') && $request->has_email !== '') {
            if ($request->has_email === '1') {
                $query->whereNotNull('email')->where('email', '!=', '');
            } else {
                $query->where(function ($q) {
                    $q->whereNull('email')->orWhere('email', '=', '');
                });
            }
        }

        // Filter by RSVP status
        if ($request->has('status') && $request->status && $request->status !== 'all') {
            switch ($request->status) {
                case 'responded':
                    $query->whereHas('group.rsvps');
                    break;
                case 'pending':
                    $query->whereDoesntHave('group.rsvps');
                    break;
                case 'attending':
                    $query->whereHas('group.rsvps', function ($q) {
                        $q->where('attending_count', '>', 0);
                    });
                    break;
                case 'not_attending':
                    $query->whereHas('group.rsvps', function ($q) {
                        $q->where('attending_count', '=', 0);
                    });
                    break;
            }
        }

        $guests = $query->orderBy('full_name')
            ->paginate($request->get('per_page', 15))
            ->withQueryString()
            ->through(function ($guest) {
                // Add has_rsvp attribute to the guest
                if ($guest->group) {
                    $guest->has_rsvp = $guest->group->hasRsvp();
                }
                return $guest;
            });

        // Get all groups for filter dropdown
        $groups = Group::orderBy('name')->get(['id', 'name']);

        return Inertia::render('Admin/Guests/Index', [
            'guests' => $guests,
            'groups' => $groups,
            'filters' => $request->only(['search', 'group_id', 'has_email', 'status', 'per_page']),
        ]);
    }

    /**
     * Show the form for creating a new guest.
     */
    public function create(): Response
    {
        $groups = Group::orderBy('name')->get(['id', 'name']);

        return Inertia::render('Admin/Guests/Create', [
            'groups' => $groups,
        ]);
    }

    /**
     * Store a newly created guest in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        Guest::create($validated);

        return redirect()
            ->route('admin.guests.index')
            ->with('success', 'Guest created successfully.');
    }

    /**
     * Display the specified guest.
     */
    public function show(Guest $guest): Response
    {
        $guest->load(['group', 'group.rsvps' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        // Add has_rsvp attribute to the guest's group
        if ($guest->group) {
            $guest->group->has_rsvp = $guest->group->hasRsvp();
        }

        return Inertia::render('Admin/Guests/Show', [
            'guest' => $guest,
        ]);
    }

    /**
     * Show the form for editing the specified guest.
     */
    public function edit(Guest $guest): Response
    {
        $guest->load(['group']);
        $groups = Group::orderBy('name')->get(['id', 'name']);

        // Add group_name to the guest object for the frontend
        $guestData = $guest->toArray();
        $guestData['group_name'] = $guest->group ? $guest->group->name : null;
        
        // Add has_rsvp attribute to the guest's group
        if ($guest->group) {
            $guestData['has_rsvp'] = $guest->group->hasRsvp();
        }

        return Inertia::render('Admin/Guests/Edit', [
            'guest' => $guestData,
            'groups' => $groups,
        ]);
    }

    /**
     * Update the specified guest in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
            'group_id' => 'required|exists:groups,id',
            'full_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $guest->update($validated);

        return redirect()
            ->route('admin.guests.show', $guest)
            ->with('success', 'Guest updated successfully.');
    }

    /**
     * Remove the specified guest from storage.
     */
    public function delete(Guest $guest)
    {
        $guest->delete();

        return redirect()
            ->route('admin.guests.index')
            ->with('success', 'Guest deleted successfully.');
    }

    /**
     * Send RSVP invitation email to a guest.
     */
    public function sendRsvpEmail(Guest $guest)
    {
        // Check if guest has an email
        if (!$guest->email) {
            return back()->with('error', 'Guest does not have an email address.');
        }

        // Check if group already has RSVP
        if ($guest->group && $guest->group->hasRsvp()) {
            return back()->with('error', 'This group has already submitted an RSVP.');
        }

        try {
            Mail::to($guest->email)->send(new RsvpInvitationMail($guest));
            
            return back()->with('success', 'RSVP invitation email sent successfully to ' . $guest->full_name . '.');
        } catch (\Exception $e) {
            \Log::error('Failed to send RSVP invitation email', [
                'guest_id' => $guest->id,
                'email' => $guest->email,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Failed to send RSVP invitation email. Please try again later.');
        }
    }
}
