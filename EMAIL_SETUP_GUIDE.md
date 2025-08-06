# Booking Email Configuration Guide

## Overview
The booking system now automatically sends email notifications to both users and admins when a booking is created.

## Email Types

### 1. User Confirmation Email
- **Sent to**: Customer's email address (from booking form)
- **Template**: `resources/views/emails/booking-confirmation.blade.php`
- **Contains**: 
  - Booking details
  - Payment information
  - Contact information
  - Confirmation of event details

### 2. Admin Notification Email
- **Sent to**: Admin email (from settings)
- **Template**: `resources/views/emails/admin-booking-notification.blade.php`
- **Contains**:
  - Customer information
  - Complete booking details
  - Payment status
  - Action buttons to manage booking
  - Revenue information

## Configuration

### Mail Setup
Update your `.env` file with proper mail configuration:

```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host.com
MAIL_PORT=587
MAIL_USERNAME=your-email@domain.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@zuppie.com"
MAIL_FROM_NAME="Zuppie Events"
```

### Admin Email
The admin email is fetched from the settings table. Default admin email is configured in:
- **Model**: `App\Models\Setting`
- **Key**: `email`
- **Default**: `admin@zuppie.com`

To update admin email:
```php
Setting::set('email', 'your-admin@domain.com');
```

## Email Flow

1. **Booking Created** → `createBooking()` method in `PackageBookingForm`
2. **Email Triggered** → `sendConfirmationEmail()` method called
3. **User Email Sent** → Confirmation email to customer
4. **Admin Email Sent** → Notification email to admin
5. **Logs Created** → Success/failure logged

## Testing

### Manual Test Command
```bash
php artisan test:booking-email --booking-id=1
```

### Mail Logs
Check logs at `storage/logs/laravel.log` for email sending status:
- Success: "Booking confirmation email sent to user: email@domain.com"
- Failure: "Email sending failed: [error message]"

## Email Templates

### Customization
Both email templates are fully customizable:
- **User Email**: `resources/views/emails/booking-confirmation.blade.php`
- **Admin Email**: `resources/views/emails/admin-booking-notification.blade.php`

### Available Variables
- `$booking` - Complete booking object with relationships
- `$user` - User who made the booking
- `$isAdminNotification` - Boolean to distinguish email type

## Mail Providers

### Recommended Providers
1. **Mailgun** - Reliable for transactional emails
2. **SendGrid** - Good API and tracking
3. **Amazon SES** - Cost-effective for high volume
4. **Gmail SMTP** - For testing and low volume

### For Testing
Use `MAIL_MAILER=log` to log emails to `storage/logs/laravel.log` instead of sending them.

## Troubleshooting

### Common Issues
1. **Emails not sending**: Check SMTP credentials in `.env`
2. **Template errors**: Verify all variables are available
3. **Missing relationships**: Ensure `eventPackage` and `user` are loaded
4. **Admin email not set**: Update settings table

### Debug Steps
1. Check mail configuration: `php artisan config:clear`
2. Test mail connection: Use tinker to send test email
3. Check logs: `tail -f storage/logs/laravel.log`
4. Verify email templates render correctly

## Security Notes

- Never log sensitive email content
- Use environment variables for email credentials
- Implement rate limiting for email sending
- Consider using queues for email sending in production

## Queue Support

For better performance, consider using Laravel queues:

```php
// In BookingConfirmationMail class
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingConfirmationMail extends Mailable implements ShouldQueue
{
    use Queueable;
    // ... rest of class
}
```

Then update queue configuration in `.env`:
```env
QUEUE_CONNECTION=database
```

And run queue worker:
```bash
php artisan queue:work
```
