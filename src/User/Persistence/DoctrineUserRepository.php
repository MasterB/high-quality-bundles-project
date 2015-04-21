<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 21.04.15
 * Time: 14:54
 */


namespace User\Persistence;

use Doctrine\Common\Persistence\ManagerRegistry;
use Traditional\Bundle\UserBundle\Entity\User;
use User\Domain\Model\UserRepository;

class DoctrineUserRepository implements UserRepository {

    private $doctrine;

    public function __construct(ManagerRegistry $doctrine){
        $this->doctrine = $doctrine;
    }


    public function findAll(){
        return $this
            ->doctrine
            ->getManager()
            ->getRepository('Traditional\Bundle\UserBundle\Entity\User')
            ->findAll();
    }

    public function add(User $user)
    {
        $em = $this->doctrine->getManager();
        $em->persist($user);
    }
}