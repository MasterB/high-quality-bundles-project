<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 21.04.15
 * Time: 10:23
 */

namespace User\Command;

use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Recorder\RecordsMessages;
use User\Command\RegisterUser;
use Traditional\Bundle\UserBundle\Entity\User;
use User\Domain\Model\Country;
use User\Event\UserWasRegistered;

class RegisterUserHandler implements MessageHandler{

    private $doctrine;

    /**
     * @var RecordsMessages
     */
    private $eventRecorder;


    /**
     * @param \Symfony\Bridge\Doctrine\ManagerRegistry $doctrine
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Symfony\Bridge\Doctrine\ManagerRegistry $doctrine, RecordsMessages $eventRecorder)
    {
        $this->doctrine = $doctrine;
        $this->eventRecorder = $eventRecorder;  // Sicherstellung bei Abbruch recording
    }


    /**
     * @param RegisterUser $message
     * @return void
     */
    public function handle(Message $message)
    {
        $user = new User(
            $message->email,
            $message->password,
            Country::fromCountryCode($message->country)
        );

        $em = $this->doctrine->getManager();
        $em->persist($user);
        //$em->flush();  // in simple bus transaction

        $event = new UserWasRegistered($user);
        $this->eventRecorder->record($event);

    }
}