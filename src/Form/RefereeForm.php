<?php

namespace App\Form;


use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RefereeForm extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('name', TextType::class, array(
                'label' => 'Imię:',
                'attr' => array('class' => 'form-control')))
            ->add('surname', TextType::class, array(
                'label' => 'Nazwisko:',
                'attr' => array('class' => 'form-control')))
            ->add('birthdate', BirthdayType::class, array(
                'label' => 'Data urodzenia:',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array(
                    'class' => 'form-control js-datepicker'
                )))
            ->add('email', EmailType::class, array(
                'label' => 'E-mail:',
                'mapped' => false,
                'attr' => array('class' => 'form-control')))
            ->add('wydzial_sedziowski', TextType::class, array(
                'label' => 'Wydział sędziowski:',
                'attr' => array('class' => 'form-control')))
            ->add('level', ChoiceType::class, array(
                'label' => 'Kategoria:',
                'choices' => array(
                    'Zawodowy' => 'Zawodowy',
                    'Top Amator A' => 'Top Amator A',
                    'Top Amator B' => 'Top Amator B',
                    'Top Amator C' => 'Top Amator C',
                ),
                'attr' => array('class' => 'form-control')))

            ->add('save', SubmitType::class, array(
                'label' => 'Zapisz',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ));
    }
}