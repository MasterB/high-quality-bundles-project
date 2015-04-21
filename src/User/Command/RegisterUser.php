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

use Rhumsaa\Uuid\Uuid;


class RegisterUser implements Message {


    /**
     * Assert\Email()
     * Assert|NotNull()
     */
    public $email;

    /**
     * Assert\Length(min=8)
     */
    public $password;

    /**
     * Assert\Country
     * Assert|NotNull()
     * @var string
     */
    public $country;

    private $id;

    public function getId()
    {
        if ($this->id === null) {
            $this->id = Uuid::uuid4();
        }

        return $this->id;
    }

    //public function getCountry

}