<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class GameDetailsForm extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('league_id', TextType::class, array(
                    'label' => 'Liga',
                    'disabled' => 'disabled',
                    'attr' => array('class' => 'form-control')))
            ->add('club_id_home', TextType::class, array(
                'label' => 'Drużyna gospodarzy:',
                'disabled' => 'disabled',
                'attr' => array('class' => 'form-control')))
            ->add('club_id_away', TextType::class, array(
                'label' => 'Drużyna gości:',
                'disabled' => 'disabled',
                'attr' => array('class' => 'form-control')))
            ->add('referee_id', TextType::class, array(
                'label' => 'Sędzia:',
                'disabled' => 'disabled',
                'attr' => array('class' => 'form-control')))
            ->add('date', DateType::class, array(
                'label' => 'Data meczu:',
                'disabled' => 'disabled',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array('class' => 'form-control')))
            ->add('season', TextType::class, array(
                'label' => 'Sezon:',
                'disabled' => 'disabled',
                'attr' => array('class' => 'form-control')))
            ->add('round', TextType::class, array(
                'label' => 'Runda:',
                'disabled' => 'disabled',
                'attr' => array('class' => 'form-control')))
            ->add('match_day', TextType::class, array(
                'label' => 'Kolejka:',
                'disabled' => 'disabled',
                'attr' => array('class' => 'form-control')))
            ->add('score', TextType::class, array(
                'label' => 'Wynik:',
                'disabled' => 'disabled',
                'attr' => array('class' => 'form-control')))
            ->add('yellow_cards', TextType::class, array(
                'label' => 'Żółte kartki:',
                'disabled' => 'disabled',
                'attr' => array('class' => 'form-control')))
            ->add('red_cards', TextType::class, array(
                'label' => 'Czerwone kartki:',
                'disabled' => 'disabled',
                'attr' => array('class' => 'form-control')))
            ->add('penalties', TextType::class, array(
                'label' => 'Karne:',
                'disabled' => 'disabled',
                'attr' => array('class' => 'form-control')));
    }
}