<?php

namespace App\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LeagueForm extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add('league_name', TextType::class, array(
                'label' => 'Nazwa ligi:',
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Zapisz',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ));
    }
}