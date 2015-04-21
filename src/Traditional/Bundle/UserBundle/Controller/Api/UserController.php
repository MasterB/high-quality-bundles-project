<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 21.04.15
 * Time: 16:05
 */

namespace Traditional\Bundle\UserBundle\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use User\Command\RegisterUser;

/**
 * @Route("/api/user")
 */
class UserController extends Controller {

    /**
     * REST Aufruf: { email: '', password:'', country:'' }
     *
     * @Route("/register")
     * @Method({"POST"})
     *
     * @param Request $request
     *
     * @return Response
    */
    public function registerAction(Request $request){

        $command = $this
            ->get('jms_serializer')
            ->deserialize(
                $request->getContent(),
                RegisterUser::class,
                'json'
            )
        ;

        $this->get('command_bus')->handle($command);

        return new Response('', Response::HTTP_ACCEPTED);
    }

}