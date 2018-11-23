<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GameReportForm extends AbstractType{

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
            ->add('score', TextType::class, array(
                'label' => 'Wynik:',
                'attr' => array('class' => 'form-control')))
            ->add('yellow_cards', IntegerType::class, array(
                'label' => 'Żółte kartki:',
                'attr' => array('class' => 'form-control')))
            ->add('red_cards', IntegerType::class, array(
                'label' => 'Czerwone kartki:',
                'attr' => array('class' => 'form-control')))
            ->add('penalties', IntegerType::class, array(
                'label' => 'Karne:',
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Zapisz',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ));
    }
}