<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding RSVP Invitation</title>
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

        .rsvp-button {
            display: inline-block;
            background: linear-gradient(135deg, #e91e63 0%, #9c27b0 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 20px 0;
            text-align: center;
        }

        .rsvp-button:hover {
            opacity: 0.9;
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
            <h1>You're Invited!</h1>
            <p>Dannica & James's Wedding Celebration</p>
        </div>

        <div class="content">
            <div class="section">
                <h2>Dear {{ $guest->full_name }},</h2>
                <p>We are so excited to celebrate our special day with you! Your presence means the world to us as we begin our journey together.</p>
                <p>Please take a moment to RSVP by clicking the button below. This will help us with our wedding planning and ensure we have everything ready for our celebration.</p>
            </div>

            <div class="section">
                <h2>Wedding Details</h2>
                <p><strong>Date:</strong> June 15, 2024</p>
                <p><strong>Time:</strong> 4:00 PM</p>
                <p><strong>Venue:</strong> Garden Paradise Wedding Venue</p>
                <p><strong>Address:</strong> 123 Wedding Lane, Celebration City</p>
            </div>

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
                <p style="margin-top: 10px; font-size: 14px; color: #666;">
                    Please RSVP by May 15, 2024
                </p>
            </div>

            <div class="contact-info">
                <h3 style="margin-top: 0; color: #e91e63;">Have Questions?</h3>
                <p>If you have any questions or need assistance with your RSVP, please don't hesitate to contact us.</p>
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