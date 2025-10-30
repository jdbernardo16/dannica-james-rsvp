<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSVP Confirmation</title>
    <style>
        body {
            font-family: 'Georgia', serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #e91e63 0%, #9c27b0 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 300;
            letter-spacing: 1px;
        }

        .header p {
            margin: 10px 0 0;
            font-size: 18px;
            opacity: 0.9;
        }

        .content {
            padding: 40px 30px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section h2 {
            color: #e91e63;
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: 400;
            border-bottom: 2px solid #f8f9fa;
            padding-bottom: 10px;
        }

        .detail-item {
            margin-bottom: 15px;
        }

        .detail-label {
            font-weight: bold;
            color: #666;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 16px;
            margin-top: 5px;
        }

        .guest-list {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
        }

        .guest-name {
            padding: 5px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .guest-name:last-child {
            border-bottom: none;
        }

        .message-box {
            background-color: #f8f9fa;
            border-left: 4px solid #e91e63;
            padding: 20px;
            border-radius: 0 8px 8px 0;
            margin-top: 10px;
            font-style: italic;
        }

        .song-suggestion {
            background-color: #fff3e0;
            border-radius: 8px;
            padding: 15px;
            margin-top: 10px;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }

        .footer p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        .contact-info {
            background-color: #e8f5e9;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
        }

        .attendance-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .attending {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .not-attending {
            background-color: #ffebee;
            color: #c62828;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 28px;
            }

            .content {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>RSVP Confirmation</h1>
            <p>Thank you for responding to our wedding invitation!</p>
        </div>

        <div class="content">
            <div class="section">
                <h2>RSVP Details</h2>

                <div class="detail-item">
                    <div class="detail-label">Group Name</div>
                    <div class="detail-value">{{ $rsvp->group ? $rsvp->group->name : 'N/A' }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Attendance Status</div>
                    <div class="detail-value">
                        <span class="attendance-badge {{ $rsvp->attending_count > 0 ? 'attending' : 'not-attending' }}">
                            {{ $rsvp->attending_count > 0 ? 'Attending' : 'Not Attending' }}
                        </span>
                    </div>
                </div>

                @if ($rsvp->attending_count > 0)
                <div class="detail-item">
                    <div class="detail-label">Number of Attendees</div>
                    <div class="detail-value">{{ $rsvp->attending_count }} {{ $rsvp->attending_count == 1 ? 'guest' : 'guests' }}</div>
                </div>
                @endif

                <div class="detail-item">
                    <div class="detail-label">Guest Members</div>
                    <div class="guest-list">
                        @if ($rsvp->group && $rsvp->group->guests)
                        @foreach ($rsvp->group->guests as $guest)
                        <div class="guest-name">{{ $guest->full_name }}</div>
                        @endforeach
                        @else
                        <div class="guest-name">No guests listed</div>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">{{ $rsvp->email ?: 'Not provided' }}</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Submitted On</div>
                    <div class="detail-value">{{ $rsvp->submitted_at_formatted }}</div>
                </div>
            </div>

            @if ($rsvp->message)
            <div class="section">
                <h2>Your Message</h2>
                <div class="message-box">
                    "{{ $rsvp->message }}"
                </div>
            </div>
            @endif

            @if ($rsvp->song_suggestion)
            <div class="section">
                <h2>Song Suggestion</h2>
                <div class="song-suggestion">
                    <strong>🎵 {{ $rsvp->song_suggestion }}</strong>
                    <p style="margin-top: 10px; font-size: 14px; color: #666;">Thank you for the song suggestion! We'll consider it for our wedding playlist.</p>
                </div>
            </div>
            @endif

            <div class="contact-info">
                <h3 style="margin-top: 0; color: #e91e63;">Have Questions?</h3>
                <p>If you need to make changes to your RSVP or have any questions, please don't hesitate to contact us.</p>
                <p><strong>Email:</strong> dannica.james.wedding@example.com</p>
                <p><strong>Phone:</strong> (555) 123-4567</p>
            </div>
        </div>

        <div class="footer">
            <p><strong>Dannica & James</strong></p>
            <p>Getting Married on June 15, 2024</p>
            <p style="margin-top: 15px; font-size: 12px;">This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>

</html>