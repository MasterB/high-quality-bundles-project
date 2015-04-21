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


    //public function getCountry

}