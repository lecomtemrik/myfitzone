<?php

// src/Controller/MailerController.php
namespace App\Controller\Mailer;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MailerController extends AbstractController
{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendingMail($destination, $name) : Response{
        $message = (new \Swift_Message('Bienvenue chez myfitzone'))
            ->setFrom('myfitzonewebsite@gmail.com')
            ->setTo($destination)
            ->setBody($this->render(
            // templates/hello/email.txt.twig
                'emails/welcome.html.twig',
                ['name' => $name]), 'text/html'
            )
        ;
        $this->mailer->send($message);
        return $this->redirectToRoute('compte') ;
    }

}
