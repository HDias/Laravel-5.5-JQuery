<?php

namespace Mailer\Notification;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ConfirmationMailNotification extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmação de Cadastro - (TrocarFacil.online)')
            ->greeting('Olá', $notifiable->name)
            ->line('Você está recebendo este e-mail porque fez uma solicitação de cadastro em nosso site para este email.')
            ->action('Ativar meu cadastro', url(route('mailer.register_user', $this->token)))
            ->line('Se você não se cadastrou em nosso site, desconsidere este email.')
            ->salutation('Nos vemos lá! Equipe TrocarFacil.online.');
    }
}
