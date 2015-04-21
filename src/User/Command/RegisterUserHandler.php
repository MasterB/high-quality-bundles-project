<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 21.04.15
 * Time: 10:23
 */

namespace User\Command;

use SimpleBus\Message\Handler\MessageHandler;
use User\Command\RegisterUser;
use Traditional\Bundle\UserBundle\Entity\User;
use User\Domain\Model\Country;

class RegisterUserHandler implements MessageHandler{

    private $doctrine;

    private $mailer;

    /**
     * @param \Symfony\Bridge\Doctrine\ManagerRegistry $doctrine
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Symfony\Bridge\Doctrine\ManagerRegistry $doctrine, \Swift_Mailer $mailer)
    {
        $this->doctrine = $doctrine;
        $this->mailer = $mailer;
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

        $message = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $message->setTo($user->getEmail());
        $this->get('mailer')->send($message);
    }
}