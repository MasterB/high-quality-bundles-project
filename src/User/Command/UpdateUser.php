<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 21.04.15
 * Time: 10:14
 */

namespace User\Command;

use SimpleBus\Message\Message;
use Symfony\Component\Validator\Constraints as Assert;

use Traditional\Bundle\UserBundle\Entity\User;

class UpdateUser implements Message {

    /**
     * @var User
     */
    private $user;

    /**
     * @Assert\NotNull()
     * @Assert\Email()
     */
    public $email;

    /**
     * @Assert\NotNull()
     * @Assert\Length(min=8)
     */
    public $password;

    public function __construct(User $user){

        $this->user = $user;

        $this->email = $this->user->getEmail();
    }

    public function getUser()
    {
        return $this->user;
    }

}