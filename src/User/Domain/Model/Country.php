<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 21.04.15
 * Time: 11:37
 */

// Value Object Example

namespace User\Domain\Model;

use Symfony\Component\Intl\Intl;

class Country {

    protected $countryCode;

    private function __construct($countryCode){
        // Assertion
        $countryName = Intl::getRegionBundle()->getCountryName($countryCode);

        \Assert\that($countryName)->notNull();

        $this->countryCode = $countryCode;
    }

    public static function fromCountryCode($countryCode){
        return new self($countryCode);
    }

    public function __toString(){
        return (string) $this->countryCode;
    }

}