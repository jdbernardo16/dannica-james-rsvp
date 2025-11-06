<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSVP Confirmation</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Source+Sans+Pro:wght@300;400;600;700&family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            line-height: 1.7;
            color: #1e3a5f;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #fffff0 0%, #f4d1d1 100%);
        }

        .container {
            background-color: #fffff0;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 4px 20px -4px rgba(212, 175, 55, 0.3);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .header {
            background: linear-gradient(135deg, #f4d1d1 0%, #e8b4b8 100%);
            color: #1e3a5f;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            letter-spacing: 1px;
            color: #1e3a5f;
        }

        .header p {
            margin: 10px 0 0;
            font-size: 18px;
            font-family: 'Dancing Script', cursive;
            color: #1e3a5f;
            font-weight: 700;
        }

        .content {
            padding: 40px 30px;
            background-color: #fffff0;
        }

        .section {
            margin-bottom: 30px;
        }

        .section h2 {
            color: #1e3a5f;
            font-size: 24px;
            margin-bottom: 15px;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            border-bottom: 2px solid #f4d1d1;
            padding-bottom: 10px;
        }

        .detail-item {
            margin-bottom: 15px;
        }

        .detail-label {
            font-weight: bold;
            color: #1e3a5f;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .detail-value {
            font-size: 16px;
            margin-top: 5px;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .guest-list {
            background-color: rgba(244, 209, 209, 0.3);
            border-radius: 1rem;
            padding: 15px;
            margin-top: 10px;
            border: 1px solid #e8b4b8;
        }

        .guest-name {
            padding: 8px 0;
            border-bottom: 1px solid rgba(232, 180, 184, 0.3);
            font-family: 'Source Sans Pro', sans-serif;
        }

        .guest-name:last-child {
            border-bottom: none;
        }

        .message-box {
            background: linear-gradient(135deg, rgba(255, 255, 240, 0.9) 0%, rgba(244, 209, 209, 0.9) 100%);
            border-left: 4px solid #e8b4b8;
            padding: 20px;
            border-radius: 0 1rem 1rem 0;
            margin-top: 10px;
            font-style: italic;
            border: 1px solid #e8b4b8;
            box-shadow: 0 2px 15px -3px rgba(212, 175, 55, 0.15);
        }

        .song-suggestion {
            background: linear-gradient(135deg, rgba(255, 255, 240, 0.9) 0%, rgba(244, 209, 209, 0.9) 100%);
            border-radius: 1rem;
            padding: 15px;
            margin-top: 10px;
            border: 1px solid #e8b4b8;
            box-shadow: 0 2px 15px -3px rgba(212, 175, 55, 0.15);
        }

        .footer {
            background: linear-gradient(135deg, #f4d1d1 0%, #e8b4b8 100%);
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e8b4b8;
        }

        .footer p {
            margin: 5px 0;
            font-size: 14px;
            color: #1e3a5f;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .contact-info {
            background: linear-gradient(135deg, rgba(255, 255, 240, 0.9) 0%, rgba(244, 209, 209, 0.9) 100%);
            border-radius: 1rem;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
            border: 1px solid #e8b4b8;
            box-shadow: 0 2px 15px -3px rgba(212, 175, 55, 0.15);
        }

        .attendance-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            letter-spacing: 0.5px;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .attending {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            color: #2e7d32;
            border: 1px solid #a5d6a7;
        }

        .not-attending {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            color: #c62828;
            border: 1px solid #ef9a9a;
        }

        .heart-divider {
            text-align: center;
            margin: 20px 0;
            font-size: 24px;
            color: #e8b4b8;
        }

        .heart-divider:before,
        .heart-divider:after {
            content: "";
            display: inline-block;
            height: 1px;
            width: 30%;
            background: linear-gradient(90deg, transparent, #e8b4b8, transparent);
            vertical-align: middle;
            margin: 0 10px;
        }

        .accent-text {
            font-family: 'Dancing Script', cursive;
            font-size: 1.2em;
            color: #d4af37;
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

            .heart-divider:before,
            .heart-divider:after {
                width: 20%;
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
            <div class="heart-divider">♥</div>
            <div class="section">
                <h2>Your Message</h2>
                <div class="message-box">
                    "{{ $rsvp->message }}"
                </div>
            </div>
            @endif

            @if ($rsvp->song_suggestion)
            <div class="heart-divider">♥</div>
            <div class="section">
                <h2>Song Suggestion</h2>
                <div class="song-suggestion">
                    <strong>🎵 {{ $rsvp->song_suggestion }}</strong>
                    <p style="margin-top: 10px; font-size: 14px; color: #1e3a5f;">Thank you for the song suggestion! We'll consider it for our wedding playlist.</p>
                </div>
            </div>
            @endif

            <div class="contact-info">
                <h3 style="margin-top: 0; color: #1e3a5f; font-family: 'Playfair Display', serif;">Have Questions?</h3>
                <p>If you need to make changes to your RSVP or have any questions, please don't hesitate to contact us.</p>
                <p><strong>Email:</strong> dannica.james.wedding@example.com</p>
                <p><strong>Phone:</strong> (555) 123-4567</p>
                <p style="margin-top: 10px; font-size: 12px; color: #666; font-style: italic;">*Note: Please update with actual contact details</p>
            </div>
        </div>

        <div class="footer">
            <p><strong>Dannica & James</strong></p>
            <p class="accent-text">Getting Married on December 12, 2025</p>
            <p style="margin-top: 15px; font-size: 12px;">This is an automated message. Please do not reply to this email.</p>
        </div>
    </div>
</body>

</html>