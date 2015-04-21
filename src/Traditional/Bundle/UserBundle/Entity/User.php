<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;
use Symfony\Component\Validator\Constraints as Assert;
use User\Domain\Model\Country;
use User\Event\UserWasRegistered;

/**
 * @ORM\Entity
 * @ORM\Table(name="traditional_user")
 */
class User implements ContainsRecordedMessages
{
    // Trait
    use PrivateMessageRecorderCapabilities;


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $country;


    public function __construct($email, $password, Country $country){
        $this->setEmail($email);
        $this->setPassword($password);
        $this->country = (string) $country;
    }

    public static function register($email, $password, Country $country)
    {
        $user = new self($email, $password, $country);
        $event = new UserWasRegistered($user);
        $user->record($event);

        return $user;
    }




    public function getId()
    {
        return $this->id;
    }

    /*
    public function setId($id)
    {
        $this->id = $id;
    }
    */

    public function getEmail()
    {
        return $this->email;
    }

    private function setEmail($email)
    {
        \Assert\that($email)->email();

        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    private function setPassword($password)
    {
        \Assert\that($password)->string()->minLength(8);

        $this->password = $password;
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return Country::fromCountryCode($this->country);
    }

    /*
    private function setCountry($country)
    {
        // Assertion
        $countryName = Intl::getRegionBundle()->getCountryName($country);
        \Assert\that($country)->notNull($countryName);


        $this->country = $country;
    }
    */
}
