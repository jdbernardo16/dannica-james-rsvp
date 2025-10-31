<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>RSVPs Export</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        .rsvp-item {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .rsvp-details {
            margin-bottom: 10px;
        }
        .field-label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .field-value {
            margin-bottom: 5px;
        }
        .guest-names {
            font-style: italic;
            color: #666;
        }
        .message {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .song-suggestion {
            background-color: #f0f8ff;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        RSVP Responses - {{ date('F j, Y') }}
    </div>

    @foreach($rsvps as $rsvp)
        <div class="rsvp-item">
            <div class="rsvp-details">
                <div class="field-label">Group Name:</div>
                <div class="field-value">{{ $rsvp->group ? $rsvp->group->name : 'Unknown Group' }}</div>
                
                <div class="field-label">Guest Names:</div>
                <div class="field-value guest-names">
                    @if($rsvp->group && $rsvp->group->guests)
                        {{ $rsvp->group->guests->pluck('full_name')->implode(', ') }}
                    @else
                        No guests listed
                    @endif
                </div>
                
                <div class="field-label">Email:</div>
                <div class="field-value">{{ $rsvp->email }}</div>
                
                <div class="field-label">Attending Count:</div>
                <div class="field-value">{{ $rsvp->attending_count }} / {{ $rsvp->group ? $rsvp->group->max_attendees : 0 }}</div>
                
                <div class="field-label">Submitted At:</div>
                <div class="field-value">{{ $rsvp->submitted_at ? $rsvp->submitted_at->format('F j, Y \a\t g:i A') : '' }}</div>
            </div>
            
            @if($rsvp->message)
                <div class="field-label">Message:</div>
                <div class="message">{{ $rsvp->message }}</div>
            @endif
            
            @if($rsvp->song_suggestion)
                <div class="field-label">Song Suggestion:</div>
                <div class="song-suggestion">{{ $rsvp->song_suggestion }}</div>
            @endif
        </div>
    @endforeach
</body>
</html>