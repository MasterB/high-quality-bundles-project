<?php

namespace Traditional\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use User\Command\UpdateUser;

class UpdateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', ['label' => 'Your email address'])
            ->add('password', 'password', ['label' => 'Your password'])
            ->add('submit', 'submit', ['label' => 'update'])
        ;
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array('data_class' => UpdateUser::class)
        );
    }

    public function getName()
    {
        return 'update_user';
    }
}
