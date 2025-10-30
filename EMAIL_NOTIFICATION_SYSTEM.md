# RSVP Email Notification System

This document describes the email notification system implemented for RSVP confirmations in the wedding RSVP application.

## Overview

The system automatically sends a confirmation email to guests when they submit an RSVP. The email includes all the details of their RSVP and a professional wedding-themed design.

## Components

### 1. Mailable Class (`app/Mail/RsvpConfirmationMail.php`)

The `RsvpConfirmationMail` class is responsible for building and sending the RSVP confirmation email. It:

- Accepts an RSVP model instance in the constructor
- Loads the associated group and guest data
- Defines the email subject and content
- Uses the `rsvp-confirmation` view for the email template

### 2. Email Template (`resources/views/mail/rsvp-confirmation.blade.php`)

A responsive, professional HTML email template that includes:

- Wedding-themed header with gradient background
- RSVP details section showing:
    - Group name
    - Attendance status with visual badge
    - Number of attendees
    - Guest member list
    - Email address
    - Submission date
- Personal message section (if provided)
- Song suggestion section (if provided)
- Contact information for questions
- Footer with couple's names and wedding date

### 3. Controller Integration (`app/Http/Controllers/RsvpController.php`)

The `RsvpController` has been updated to:

- Import the `RsvpConfirmationMail` and `Mail` facade
- Send the confirmation email when an RSVP is submitted (if email is provided)
- Include error handling with logging for email failures
- Support resending confirmation emails via the `resendConfirmation` method

### 4. Email Preview Route

A preview route has been added at `/rsvp/preview-email` to:

- Display a sample email for testing purposes
- Help with email template design verification
- Use sample data to demonstrate the email appearance

## Configuration

### Mail Settings (`.env`)

The mail configuration has been set up to use SMTP:

```
MAIL_MAILER=smtp
MAIL_SCHEME=tls
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_FROM_ADDRESS="dannica.james.wedding@example.com"
MAIL_FROM_NAME="Dannica & James"
```

**Note:** Replace the MailTrap credentials with your actual SMTP server details for production use.

## Usage

### Automatic Email Sending

When a guest submits an RSVP form:

1. The RSVP is saved to the database
2. If an email address is provided, a confirmation email is automatically sent
3. The email includes all RSVP details and a thank you message
4. Errors are logged but don't prevent the RSVP from being saved

### Manual Email Resending

Administrators can resend confirmation emails through the `resendConfirmation` method, which is accessible via the `/rsvp/resend-confirmation` endpoint.

### Email Preview

To preview the email template:

1. Ensure the Laravel development server is running
2. Navigate to `http://127.0.0.1:8001/rsvp/preview-email`
3. The preview shows sample data to demonstrate the email appearance

## Features

- **Responsive Design**: The email template is mobile-friendly and adapts to different screen sizes
- **Professional Theme**: Wedding-themed design with elegant colors and typography
- **Dynamic Content**: Shows different content based on RSVP data (attending/not attending, message, song suggestion)
- **Error Handling**: Graceful handling of email sending failures with proper logging
- **Conditional Display**: Only shows sections for message and song suggestion if they are provided

## Testing

The email system has been tested with:

- Sample RSVP data
- Email template rendering
- Error handling scenarios
- Mobile responsiveness

## Production Considerations

1. **Mail Configuration**: Update the `.env` file with your production SMTP credentials
2. **Queue Support**: For high traffic, consider implementing queue support for email sending
3. **Email Validation**: Ensure email addresses are properly validated before sending
4. **Rate Limiting**: Consider implementing rate limiting to prevent email spam
5. **Bounce Handling**: Set up bounce handling for invalid email addresses

## Troubleshooting

### Email Not Sending

- Check mail configuration in `.env`
- Verify SMTP credentials are correct
- Check Laravel logs for error messages
- Ensure the mail driver is properly configured

### Template Issues

- Use the preview route to verify template appearance
- Check for any syntax errors in the Blade template
- Verify all data is properly loaded before accessing

### Performance Issues

- Consider implementing queue support for email sending
- Optimize email template for faster rendering
- Monitor email sending performance
