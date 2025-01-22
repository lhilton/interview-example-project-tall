<?php

namespace App\Notifications;

use App\Models\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class WebsiteDown extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param  Collection<int, Website>  $websites
     */
    public function __construct(public Collection $websites) {}

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
            ->subject('Website Down')
            ->markdown('mail.websites.down', ['websites' => $this->websites]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'websites' => $this->websites,
        ];
    }
}
