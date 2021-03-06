<?php

namespace Traditional\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use User\Command\RegisterUser;

class CreateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', ['label' => 'Your email address'])
            ->add('password', 'password', ['label' => 'Your password'])
            ->add('country', 'country', ['label' => 'Your country'])
            ->add('submit', 'submit');
    }



    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array('data_class' => RegisterUser::class)
        );
    }

    public function getName()
    {
        return 'create_user';
    }
}
