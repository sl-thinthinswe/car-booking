<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewBookingNotification extends Notification
{
    use Queueable;

    public $booking;


    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->subject('New Booking Created')
                                ->greeting('Hello Admin,')
                                ->line('A new booking has been made by: ' . $this->booking->user->name)
                                ->line('Trip: ' . optional($this->booking->trip->route->departure)->name . ' → ' . optional($this->booking->trip->route->arrival)->name)
                                ->line('Seats: ' . $this->booking->number_of_seat)
                                ->line('Total: ' . number_format($this->booking->total_amount) . ' MMK')
                                ->action('View Booking', url(route('admin.bookings.show', $this->booking->id)))
                                ->line('Thank you!');
    }
    public function toDatabase($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'user_name' => $this->booking->user->name,
            'trip' => optional($this->booking->trip->route->departure)->name . ' → ' . optional($this->booking->trip->route->arrival)->name,
            'seats' => $this->booking->number_of_seat,
            'total' => $this->booking->total_amount,
        ];
    }   
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
