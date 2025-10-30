<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class GroupController extends Controller
{
    /**
     * Display a listing of the groups.
     */
    public function index(Request $request)
    {
        $query = Group::with(['guests'])
            ->withCount('guests');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by RSVP status
        if ($request->has('rsvp_status') && $request->rsvp_status && $request->rsvp_status !== 'all') {
            switch ($request->rsvp_status) {
                case 'submitted':
                    $query->whereHas('rsvps');
                    break;
                case 'pending':
                    $query->whereDoesntHave('rsvps');
                    break;
                case 'attending':
                    $query->whereHas('rsvps', function ($q) {
                        $q->where('attending_count', '>', 0);
                    });
                    break;
                case 'not_attending':
                    $query->whereHas('rsvps', function ($q) {
                        $q->where('attending_count', '=', 0);
                    });
                    break;
            }
        }

        $groups = $query->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Groups/Index', [
            'groups' => $groups,
            'filters' => $request->only(['search', 'rsvp_status']),
        ]);
    }

    /**
     * Show the form for creating a new group.
     */
    public function create(): Response
    {
        return Inertia::render('Admin/Groups/Create');
    }

    /**
     * Store a newly created group in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:groups',
            'max_attendees' => 'nullable|integer|min:1|max:20',
        ]);

        $group = Group::create($validated);

        return redirect()
            ->route('admin.groups.show', $group)
            ->with('success', 'Group created successfully.');
    }

    /**
     * Display the specified group.
     */
    public function show(Group $group): Response
    {
        $group->load(['guests', 'rsvps' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return Inertia::render('Admin/Groups/Show', [
            'group' => $group,
        ]);
    }

    /**
     * Show the form for editing the specified group.
     */
    public function edit(Group $group): Response
    {
        $group->load(['guests']);

        return Inertia::render('Admin/Groups/Edit', [
            'group' => $group,
        ]);
    }

    /**
     * Update the specified group in storage.
     */
    public function update(Request $request, Group $group)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('groups')->ignore($group->id),
            ],
            'max_attendees' => 'nullable|integer|min:1|max:20',
        ]);

        $group->update($validated);

        return redirect()
            ->route('admin.groups.show', $group)
            ->with('success', 'Group updated successfully.');
    }

    /**
     * Remove the specified group from storage.
     */
    public function delete(Group $group)
    {
        // Check if group has RSVPs before deletion
        if ($group->rsvps()->exists()) {
            return back()->with('error', 'Cannot delete group with existing RSVPs.');
        }

        // Delete guests first (they have foreign key constraint)
        $group->guests()->delete();

        // Delete the group
        $group->delete();

        return redirect()
            ->route('admin.groups.index')
            ->with('success', 'Group deleted successfully.');
    }
}
