<?php

namespace Traditional\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Traditional\Bundle\UserBundle\Entity\User;
use Traditional\Bundle\UserBundle\Form\CreateUserType;
use Traditional\Bundle\UserBundle\Form\UpdateUserType;
use User\Command\RegisterUser;
use User\Command\UpdateUser;

/**
 * @Route("/")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="user_list")
     * @Template
     */
    public function listAction()
    {

        $users = $this->get('user_repository')->findAll();

        return array(
            'users' => $users
        );
    }

    /**
     * @Route("/create-user", name="user_create")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function createAction(Request $request)
    {
        // Default values on Controller
        $command = new RegisterUser();
        $command->email = 'xxx@webtech.ch';

        $form = $this->createForm(new CreateUserType(), $command);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $command = $form->getData();

            $this->get('command_bus')->handle($command);

            return $this->redirect($this->generateUrl('user_list', [$command->getId()]));

        }

        return array(
            'form' => $form->createView()
        );
    }


    /**
     * @Route("/{id}/update-user", name="user_update")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function updateAction(Request $request, $id)
    {
        $user = $this->get('user_repository')->find($id);

        $command = new UpdateUser($user);

        $form = $this->createForm(new UpdateUserType(), $command);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $command = $form->getData();

            $this->get('command_bus')->handle($command);

            return $this->redirect($this->generateUrl('user_list'));

        }

        return array(
            'form' => $form->createView()
        );
    }
}
