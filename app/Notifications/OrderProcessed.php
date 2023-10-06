<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderProcessed extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $item;
    protected $user;
    protected $booking;
    public function __construct($item, $user,$booking)
    {
        $this->item = $item;
        $this->user = $user;
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Greetings ' . ucwords($this->user->username) . ' !!')
            ->line('Your flight to ' . $this->item->name . ' was succesfully booked .')
            ->line('The price is ' . $this->item->price . ' was succesfully booked .')
            ->attach($this->booking->file->path)
            ->line('Thank you for using our application!');
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
