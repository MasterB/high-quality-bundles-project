<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 21.04.15
 * Time: 14:47
 */

namespace User\Domain\Model;
use Traditional\Bundle\UserBundle\Entity\User;

interface UserRepository {

    public function add(User $user);

    public function findAll();

}