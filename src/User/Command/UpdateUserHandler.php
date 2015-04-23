<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 21.04.15
 * Time: 10:23
 */

namespace User\Command;

use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;
use User\Command\UpdateUser;
use Traditional\Bundle\UserBundle\Entity\User;
use User\Domain\Model\UserRepository;

class UpdateUserHandler implements MessageHandler{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepositpry = $userRepository;
    }


    /**
     * Handles the given message.
     *
     * @param UpdateUser $message
     * @return void
     */
    public function handle(Message $message)
    {
        $user = $message->getUser();

        $user->update($message->email, $message->password);

        $this->userRepositpry->update($user);
    }
}