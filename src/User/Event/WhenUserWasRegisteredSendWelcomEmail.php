<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 21.04.15
 * Time: 13:10
 */

namespace User\Event;

use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;

class WhenUserWasRegisteredSendWelcomEmail implements MessageSubscriber
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer){

        $this->mailer = $mailer;
    }



    public function notify(Message $message){

        $mailMessage = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $mailMessage->setTo($message->user()->getEmail());

        $this->mailer->send($mailMessage);
    }
}