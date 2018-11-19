<?php

namespace App\Form;

use App\Entity\Clubs;
use App\Entity\League;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClubForm extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('club_name', TextType::class, array(
                'label' => 'Nazwa klubu:',
                'attr' => array('class' => 'form-control')))
            ->add('league_id', EntityType::class, array(
                'label' => 'Liga',
                'class' => League::class,
                'attr' => array('class' => 'form-control')))
            ->add('stadium', TextType::class, array(
                'label' => 'Stadion:',
                'attr' => array('class' => 'form-control')))
            ->add('founded_year', IntegerType::class, array(
                'label' => 'Rok założenia:',
                'attr' => array('class' => 'form-control')))

            ->add('save', SubmitType::class, array(
                'label' => 'Zapisz',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ));
    }
}