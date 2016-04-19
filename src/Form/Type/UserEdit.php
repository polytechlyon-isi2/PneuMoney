<?php

namespace PneuMoney\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserEdit extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', 'repeated', array(
                'type'            => 'password',
                'invalid_message' => 'The password fields must match.',
                'options'         => array('required' => true),
                'first_options'   => array('label' => 'Password'),
                'second_options'  => array('label' => 'Repeat password'),
            ))
            ->add('Nom', 'text')
      			->add('Prenom', 'text')
            ->add('role', 'choice', array(
                'choices' => array('ROLE_USER' => 'User')
            ))
			;
    }


    public function getName()
    {
        return 'user';
    }
}
