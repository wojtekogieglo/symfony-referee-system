<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileForm extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('name', TextType::class, array(
                'disabled' => 'disabled',
                'label' => 'Imię:',
                'attr' => array('class' => 'form-control')))
            ->add('surname', TextType::class, array(
                'disabled' => 'disabled',
                'label' => 'Nazwisko:',
                'attr' => array('class' => 'form-control')))
            ->add('birthdate', BirthdayType::class, array(
                'disabled' => 'disabled',
                'label' => 'Data urodzenia:',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array(
                    'class' => 'form-control js-datepicker'
                )))
            ->add('user_id', TextType::class, array(
                'disabled' => 'disabled',
                'label' => 'E-mail:',
                'attr' => array('class' => 'form-control')))
            ->add('wydzial_sedziowski', TextType::class, array(
                'disabled' => 'disabled',
                'label' => 'Wydział sędziowski:',
                'attr' => array('class' => 'form-control')))
            ->add('level', TextType::class, array(
                'disabled' => 'disabled',
                'label' => 'Kategoria:',
                'attr' => array('class' => 'form-control')));
    }
}