<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendEmailToAdminAfterRegistrationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $code;
    public $email;
    public function __construct($codeToSend, $sendToemail)
    {
        $this->code = $codeToSend;
        $this->email = $sendToemail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Création du compte administrateur')
                    ->line('Bonjour')
                    ->line('Votre compte a été créé avec succès sur la plateforme de gestion des ressources humaines de la DREN')
                    ->line('Cliquez sur le bouton ci-dessous pour valider votre compte')
                    ->line('Saisissez le code '.$this->code.'et renseigner le dans le formulaire qui apparaîtra lorsque vous cliquerez sur le bouton ci-dessous')
                    ->action('Cliquez ici', url('/validate-account'.'/'.$this->email))
                    ->line('Merci d\'utiliser nos services!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
