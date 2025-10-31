<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding RSVP Invitation</title>
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

        .rsvp-button {
            display: inline-block;
            background: linear-gradient(135deg, #ffd700 0%, #d4af37 50%, #b8860b 100%);
            color: #1e3a5f;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 2rem;
            font-weight: 600;
            font-family: 'Source Sans Pro', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 20px 0;
            text-align: center;
            box-shadow: 0 4px 15px -3px rgba(212, 175, 55, 0.3);
            transition: all 0.3s ease;
        }

        .rsvp-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(212, 175, 55, 0.4);
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
            <h1>You're Invited!</h1>
            <p>Dannica & James's Wedding Celebration</p>
        </div>

        <div class="content">
            <div class="section">
                <h2>Dear {{ $guest->full_name }},</h2>
                <p>We are so excited to celebrate our special day with you! Your presence means the world to us as we begin our journey together.</p>
                <p>Please take a moment to RSVP by clicking the button below. This will help us with our wedding planning and ensure we have everything ready for our celebration.</p>
            </div>

            <div class="heart-divider">♥</div>

            <div class="section">
                <h2>Wedding Details</h2>
                <p><strong>Date:</strong> December 12, 2025</p>
                <p><strong>Ceremony:</strong> San Agustine Church Immaculate Conception Parish</p>
                <p><strong>Ceremony Address:</strong> Gen. Luna Street Intramuros, Manila</p>
                <p><strong>Ceremony Time:</strong> 2:30 PM (Entourage Procession begins at 2:30 PM, Ceremony at 3:00 PM)</p>
                <p><strong>Reception:</strong> La Castellana</p>
                <p><strong>Reception Address:</strong> Cabildo Cor. Beaterio Street Intramuros, Manila</p>
                <p><strong>Reception Time:</strong> 4:45 PM onwards</p>
            </div>

            <div class="heart-divider">♥</div>

            <div class="section">
                <h2>Your Group</h2>
                <div class="guest-list">
                    @if ($guest->group && $guest->group->guests)
                    @foreach ($guest->group->guests as $groupGuest)
                    <div class="guest-name">{{ $groupGuest->full_name }}</div>
                    @endforeach
                    @else
                    <div class="guest-name">{{ $guest->full_name }}</div>
                    @endif
                </div>
            </div>

            <div class="section" style="text-align: center;">
                <a href="{{ url('/rsvp') }}" class="rsvp-button">RSVP Now</a>
                <p style="margin-top: 10px; font-size: 14px; color: #1e3a5f;">
                    Please RSVP by November 15, 2025
                </p>
            </div>

            <div class="contact-info">
                <h3 style="margin-top: 0; color: #1e3a5f; font-family: 'Playfair Display', serif;">Have Questions?</h3>
                <p>If you have any questions or need assistance with your RSVP, please don't hesitate to contact us.</p>
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