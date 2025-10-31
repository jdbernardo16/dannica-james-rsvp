<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use App\Models\Group;
use App\Models\Guest;
use App\Mail\RsvpConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\JsonResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class RsvpController extends Controller
{
    /**
     * Display a listing of the RSVPs (admin).
     */
    public function index(Request $request)
    {
        $query = Rsvp::with(['group', 'group.guests']);

        // Filter by attendance status
        if ($request->has('status') && $request->status && $request->status !== 'all') {
            if ($request->status === 'attending') {
                $query->attending();
            } elseif ($request->status === 'not_attending') {
                $query->notAttending();
            } elseif ($request->status === 'partial') {
                $query->where('attending_count', '>', 0)->where('attending_count', '<', function($q) {
                    $q->selectRaw('max_attendees')->from('groups')->whereColumn('groups.id', 'rsvps.group_id');
                });
            }
        }

        // Search by group name or email
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('group', function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%");
                })->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('submitted_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('submitted_at', '<=', $request->date_to);
        }

        $rsvps = $query->latestSubmitted()
            ->paginate($request->get('per_page', 15))
            ->withQueryString()
            ->through(function ($rsvp) {
                // Transform the RSVP data to include group information as direct properties
                $rsvp->group_name = $rsvp->group ? $rsvp->group->name : null;
                $rsvp->max_attendees = $rsvp->group ? $rsvp->group->max_attendees : null;
                return $rsvp;
            });

        return Inertia::render('Admin/Rsvps/Index', [
            'rsvps' => $rsvps,
            'filters' => $request->only(['search', 'status', 'date_from', 'date_to', 'per_page']),
        ]);
    }

    /**
     * Display the specified RSVP (admin).
     */
    public function show(Rsvp $rsvp): Response
    {
        $rsvp->load(['group', 'group.guests']);

        // Transform the RSVP data to include group information as direct properties
        $rsvp->group_name = $rsvp->group ? $rsvp->group->name : null;
        $rsvp->max_attendees = $rsvp->group ? $rsvp->group->max_attendees : null;

        return Inertia::render('Admin/Rsvps/Show', [
            'rsvp' => $rsvp,
        ]);
    }

    /**
     * Export RSVPs to a file (admin).
     */
    public function export(Request $request): StreamedResponse
    {
        $query = Rsvp::with(['group', 'group.guests']);

        // Apply same filters as index
        if ($request->has('status') && $request->status && $request->status !== 'all') {
            if ($request->status === 'attending') {
                $query->attending();
            } elseif ($request->status === 'not_attending') {
                $query->notAttending();
            } elseif ($request->status === 'partial') {
                $query->where('attending_count', '>', 0)->where('attending_count', '<', function($q) {
                    $q->selectRaw('max_attendees')->from('groups')->whereColumn('groups.id', 'rsvps.group_id');
                });
            }
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('group', function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%");
                })->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('submitted_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('submitted_at', '<=', $request->date_to);
        }

        $rsvps = $query->latestSubmitted()->get()->each(function ($rsvp) {
            // Transform RSVP data to include group information as direct properties
            $rsvp->group_name = $rsvp->group ? $rsvp->group->name : null;
            $rsvp->max_attendees = $rsvp->group ? $rsvp->group->max_attendees : null;
            // Ensure the formatted date is available
            $rsvp->submitted_at_formatted = $rsvp->submitted_at ? $rsvp->submitted_at->format('F j, Y \a\t g:i A') : '';
        });

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="rsvps_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($rsvps) {
            $file = fopen('php://output', 'w');

            // CSV header
            fputcsv($file, [
                'Group Name',
                'Guest Names',
                'Email',
                'Attending Count',
                'Message',
                'Song Suggestion',
                'Submitted At'
            ]);

            // CSV data
            foreach ($rsvps as $rsvp) {
                $guestNames = $rsvp->group && $rsvp->group->guests ? $rsvp->group->guests->pluck('full_name')->implode(', ') : '';

                fputcsv($file, [
                    $rsvp->group ? $rsvp->group->name : 'Unknown Group',
                    $guestNames,
                    $rsvp->email,
                    $rsvp->attending_count,
                    $rsvp->message,
                    $rsvp->song_suggestion,
                    $rsvp->submitted_at_formatted,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export RSVPs to PDF file (admin).
     */
    public function exportPdf(Request $request)
    {
        $query = Rsvp::with(['group', 'group.guests']);

        // Apply same filters as index
        if ($request->has('status') && $request->status && $request->status !== 'all') {
            if ($request->status === 'attending') {
                $query->attending();
            } elseif ($request->status === 'not_attending') {
                $query->notAttending();
            } elseif ($request->status === 'partial') {
                $query->where('attending_count', '>', 0)->where('attending_count', '<', function($q) {
                    $q->selectRaw('max_attendees')->from('groups')->whereColumn('groups.id', 'rsvps.group_id');
                });
            }
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('group', function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', "%{$search}%");
                })->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('submitted_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('submitted_at', '<=', $request->date_to);
        }

        $rsvps = $query->latestSubmitted()->get()->map(function ($rsvp) {
            // Transform the RSVP data to include group information as direct properties
            $rsvp->group_name = $rsvp->group ? $rsvp->group->name : null;
            $rsvp->max_attendees = $rsvp->group ? $rsvp->group->max_attendees : null;
            return $rsvp;
        });

        // Generate PDF
        $pdf = Pdf::loadView('pdf.rsvps', ['rsvps' => $rsvps])
            ->setPaper('a4')
            ->setOption('font-family', 'Arial')
            ->setOption('margin-top', '20px')
            ->setOption('margin-bottom', '20px')
            ->setOption('margin-left', '15px')
            ->setOption('margin-right', '15px');

        return $pdf->download('rsvps_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Show the form for creating a new RSVP (public).
     */
    public function create(): Response
    {
        return Inertia::render('Rsvp/Create');
    }

    /**
     * Store a newly created RSVP in storage (public).
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_name' => 'required|string|max:255',
            'guest_names' => 'required|array|min:1',
            'guest_names.*' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'attending_count' => 'required|integer|min:0|max:20',
            'message' => 'nullable|string|max:1000',
            'song_suggestion' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // Find or create group
        $group = Group::firstOrCreate(
            ['name' => $request->group_name],
            ['max_attendees' => $request->attending_count]
        );

        // Check if group already has an RSVP
        if ($group->rsvps()->exists()) {
            return back()
                ->with('error', 'This group has already submitted an RSVP.')
                ->withInput();
        }

        // Create guests
        $guests = [];
        foreach ($request->guest_names as $guestName) {
            $guests[] = [
                'group_id' => $group->id,
                'full_name' => $guestName,
                'email' => $request->email, // Use same email for all guests in group
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Delete existing guests for this group (if any) and create new ones
        $group->guests()->delete();
        $group->guests()->insert($guests);

        // Create RSVP
        $rsvp = Rsvp::create([
            'group_id' => $group->id,
            'attending_count' => $request->attending_count,
            'message' => $request->message,
            'song_suggestion' => $request->song_suggestion,
            'email' => $request->email,
            'submitted_at' => now(),
        ]);

        // Send confirmation email if email is provided
        if ($rsvp->email) {
            try {
                Mail::to($rsvp->email)->send(new RsvpConfirmationMail($rsvp));
                Log::info('RSVP confirmation email sent successfully', ['rsvp_id' => $rsvp->id, 'email' => $rsvp->email]);
            } catch (\Exception $e) {
                Log::error('Failed to send RSVP confirmation email', [
                    'rsvp_id' => $rsvp->id,
                    'email' => $rsvp->email,
                    'error' => $e->getMessage()
                ]);
                // Continue with the process even if email fails
            }
        }

        // Store RSVP ID in session for confirmation page
        Session::put('rsvp_id', $rsvp->id);

        return redirect()->route('rsvp.confirmation');
    }

    /**
     * Show the confirmation page after RSVP submission (public).
     */
    public function confirmation(): Response
    {
        $rsvpId = Session::get('rsvp_id');
        $rsvp = null;

        if ($rsvpId) {
            $rsvp = Rsvp::with(['group', 'group.guests'])->find($rsvpId);
            
            // Transform the RSVP data to include group information as direct properties
            if ($rsvp) {
                $rsvp->group_name = $rsvp->group ? $rsvp->group->name : null;
                $rsvp->max_attendees = $rsvp->group ? $rsvp->group->max_attendees : null;
            }
            
            // Clear the session variable
            Session::forget('rsvp_id');
        }

        return Inertia::render('Rsvp/Confirmation', [
            'rsvp' => $rsvp,
        ]);
    }

    /**
     * Check if guest name exists in the database (AJAX endpoint).
     */
    public function checkGuest(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $name = $request->input('name');

        // Search for guest by full name
        $guest = Guest::where('full_name', 'like', "%{$name}%")
            ->with(['group'])
            ->first();

        if ($guest) {
            // Check if group already has RSVP
            $hasRsvp = $guest->group->rsvps()->exists();

            return response()->json([
                'found' => true,
                'guest' => [
                    'id' => $guest->id,
                    'full_name' => $guest->full_name,
                    'email' => $guest->email,
                ],
                'group' => [
                    'id' => $guest->group->id,
                    'name' => $guest->group->name,
                    'max_attendees' => $guest->group->max_attendees,
                    'has_rsvp' => $hasRsvp,
                ],
                'group_guests' => $guest->group->guests()->pluck('full_name')->toArray(),
            ]);
        }

        return response()->json([
            'found' => false,
            'message' => 'Guest not found. Please check the name or contact the couple.',
        ]);
    }

    /**
     * Resend confirmation email for an RSVP.
     */
    public function resendConfirmation(Request $request): JsonResponse
    {
        $request->validate([
            'rsvp_id' => 'required|exists:rsvps,id',
        ]);

        $rsvp = Rsvp::with(['group', 'group.guests'])->find($request->rsvp_id);

        if (!$rsvp) {
            return response()->json([
                'success' => false,
                'message' => 'RSVP not found.',
            ], 404);
        }

        // Transform the RSVP data to include group information as direct properties
        $rsvp->group_name = $rsvp->group ? $rsvp->group->name : null;
        $rsvp->max_attendees = $rsvp->group ? $rsvp->group->max_attendees : null;

        // Send confirmation email if email is provided
        if ($rsvp->email) {
            try {
                Mail::to($rsvp->email)->send(new RsvpConfirmationMail($rsvp));
                Log::info('RSVP confirmation email resent successfully', ['rsvp_id' => $rsvp->id, 'email' => $rsvp->email]);
            } catch (\Exception $e) {
                Log::error('Failed to resend RSVP confirmation email', [
                    'rsvp_id' => $rsvp->id,
                    'email' => $rsvp->email,
                    'error' => $e->getMessage()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to send confirmation email. Please try again later.',
                ], 500);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No email address associated with this RSVP.',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Confirmation email has been resent successfully.',
        ]);
    }

    /**
     * Preview the RSVP confirmation email.
     */
    public function previewEmail(Request $request)
    {
        // For testing purposes, we'll create a sample RSVP
        // In production, you might want to restrict this to admin users only
        $sampleRsvp = new Rsvp([
            'attending_count' => 2,
            'message' => 'We are so excited to celebrate with you! Looking forward to the special day.',
            'song_suggestion' => 'Perfect by Ed Sheeran',
            'email' => 'guest@example.com',
            'submitted_at' => now(),
        ]);

        // Create a sample group with guests
        $sampleGroup = new Group([
            'name' => 'The Johnson Family',
        ]);

        $sampleGroup->setRelation('guests', collect([
            new Guest(['full_name' => 'John Johnson']),
            new Guest(['full_name' => 'Jane Johnson']),
        ]));

        $sampleRsvp->setRelation('group', $sampleGroup);

        return new RsvpConfirmationMail($sampleRsvp);
    }
}
