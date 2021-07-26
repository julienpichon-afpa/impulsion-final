<?php

namespace App\Classe;

use App\Entity\Order;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Message;

class MyMail
{
    private $mailer; //mailer interface
    private $email;


    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    // Fonction qui envoi notre confirmation d'inscription
    public function sendRegisterSuccess($recipientMail, $recipientFullName)
    {
        $this->email = new TemplatedEmail();
        $this->email->from('contact@impulsioncollective.com') // Mettre ici le bon nom de domaine une fois en prode
            ->to($recipientMail) // Email du destinataire
            ->subject('Votre inscription sur impulsioncollective.com')
            ->htmlTemplate('email/register_success.html.twig')
            ->context([
                'recipientMail' => $recipientMail,
                'recipientFullName' => $recipientFullName
            ]);
        $this->mailer->send($this->email);
    }

    // Fonction qui envoie une notification à l'utilisateur l'informant de l'état de sa commande
    public function sendOrderStatus(Order $order)
    {
        $this->email = new TemplatedEmail();
        $this->email->from('contact@impulsioncollective.com') // Mettre ici le bon nom de domaine une fois en prod
        ->to($order->getUser()->getEmail());// Email du destinataire
        if($order->getState() == 0)
        {
            $this->email->subject('Abandon de votre commande n°'.$order->getReference() .' sur impulsioncollective.com')
                ->htmlTemplate('email/order_status.html.twig')
                ->context([
                    'recipientMail' => $order->getUser()->getEmail(),
                    'recipientFullName' => $order->getUser()->getFullName(),
                    'orderReference' => $order->getReference(),
                    'orderStatus' => $order->getState()
                ]);
        }
        elseif($order->getState() == 1)
        {
            $this->email->subject('Confirmation de votre commande n°'.$order->getReference().'  sur impulsioncollective.com')
                ->htmlTemplate('email/order_status.html.twig')
                ->context([
                    'recipientMail' => $order->getUser()->getEmail(),
                    'recipientFullName' =>  $order->getUser()->getFullName(),
                    'orderReference' => $order->getReference(),
                    'orderPrice' => $order->getTotal(),
                    'orderStatus' => $order->getState()
                ]);
        }
        elseif($order->getState() == 2)
        {
            $this->email->subject('Votre commande n°'.$order->getReference().'  est en cours de préparation !')
                ->htmlTemplate('email/order_status.html.twig')
                ->context([
                    'recipientMail' => $order->getUser()->getEmail(),
                    'recipientFullName' =>  $order->getUser()->getFullName(),
                    'orderReference' => $order->getReference(),
                    'orderPrice' => $order->getTotal(),
                    'orderStatus' => $order->getState()
                ]);
        }
        elseif($order->getState() == 3)
        {
            $this->email->subject('Votre commande n°'.$order->getReference().'  est en cours de livraison !')
                ->htmlTemplate('email/order_status.html.twig')
                ->context([
                    'recipientMail' =>  $order->getUser()->getEmail(),
                    'recipientFullName' =>  $order->getUser()->getFullName(),
                    'orderReference' => $order->getReference(),
                    'orderPrice' => $order->getTotal(),
                    'orderStatus' => $order->getState()
                ]);
        }
        $this->mailer->send($this->email);
    }

    // Fonction qui envoi notre confirmation d'inscription
    public function sendResetPassword($resetPassword, $url)
    {
        $this->email = new TemplatedEmail();
        $this->email->from('contact@impulsioncollective.com') // Mettre ici le bon nom de domaine une fois en prode
        ->to($resetPassword->getUser()->getEmail()) // Email du destinataire
        ->subject('Mise à jour mot de passe impulsioncollective.com')
            ->htmlTemplate('email/reset_password.html.twig')
            ->context([
                'recipientMail' => $resetPassword->getUser()->getEmail(),
                'recipientFullName' => $resetPassword->getUser()->getFullName(),
                'url' => $url
            ]);

        $this->mailer->send($this->email);
    }
}