<?php

namespace App\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class PasswordForm extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('oldPassword', PasswordType::class, array(
                'label' => 'Obecne hasło:',
                'mapped' => false,
                'constraints' => new UserPassword(array(
                    'message' => 'Obecne hasło jest nieprawidłowe'
                )),
                'attr' => array('class' => 'form-control')))
            ->add('newPassword', RepeatedType::class, array(
                'error_bubbling' => true,
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Podane hasła są różne.',
                'options' => array('attr' => array(
                    'class' => 'form-control'
                )),
                'required' => true,
                'first_options'  => array(
                    'label' => 'Nowe hasło:'),
                'second_options' => array(
                    'label' => 'Powtórz hasło:')))
            ->add('save', SubmitType::class, array(
                'label' => 'Zapisz',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ));
    }
}