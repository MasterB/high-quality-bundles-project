<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 21.04.15
 * Time: 13:06
 */

namespace User\Event;

use SimpleBus\Message\Message;
use Traditional\Bundle\UserBundle\Entity\User;

class UserWasRegistered implements Message
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function user(){
        return $this->user;
    }

}