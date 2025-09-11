<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class UserAddedNotification extends Notification
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the database notification representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'message' => 'A new user has been added.',
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
        ];
    }

    // Optionally, if you want to send this notification by mail as well, uncomment this part
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //         ->line('A new user has been added.')
    //         ->action('View User', url('/users/' . $this->user->id));
    // }
}
