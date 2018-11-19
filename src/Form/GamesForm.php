<?php

namespace App\Form;

use App\Entity\Clubs;
use App\Entity\Games;
use App\Entity\League;
use App\Entity\Referee;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class GamesForm extends AbstractType{

    private $em;

    /**
     * The Type requires the EntityManager as argument in the constructor. It is autowired
     * in Symfony 3.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('referee_id', EntityType::class, array(
                'label' => 'Sędzia:',
                'class' => Referee::class,
                'placeholder' => 'Wybierz sędziego',
                'choice_label' => function ($referee, $key, $index) {
                    /** @var Referee $referee */
                    return $referee->getName() . ' ' . $referee->getSurname();
                },
                'attr' => array('class' => 'form-control')))
            ->add('date', DateType::class, array(
                'label' => 'Data meczu:',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => array(
                    'class' => 'form-control js-datepicker'
                )))
            ->add('season', TextType::class, array(
                'label' => 'Sezon:',
                'attr' => array('class' => 'form-control')))
            ->add('round', ChoiceType::class, array(
                'label' => 'Runda:',
                'choices' => array(
                    'Jesienna' => 'Jesienna',
                    'Wiosenna' => 'Wiosenna'
                ),
                'attr' => array('class' => 'form-control')))
            ->add('match_day', TextType::class, array(
                'label' => 'Kolejka:',
                'attr' => array('class' => 'form-control')))
            ->add('save', SubmitType::class, array(
                'label' => 'Zapisz',
                'attr' => array('class' => 'btn btn-primary mt-3')
            ));

        //2 event listeners for the form
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
    }

    protected function addElements(FormInterface $form, League $league = null){
        //Add the league element
        $form
            ->add('league_id', EntityType::class, array(
                'label' => 'Liga',
                'data' => $league,
                'placeholder' => 'Wybierz ligę',
                'class' => 'App\Entity\League',
                'attr' => array('class' => 'form-control')));
        //Clubs empty, unless there is a selected League (edit view)
        $clubs = array();

        if($league){
            // Fetch Neighborhoods of the City if there's a selected city
            $repoClubs = $this->em->getRepository(Clubs::class);

            $clubs = $repoClubs->createQueryBuilder("q")
                ->where("q.league_id = :leagueId")
                ->setParameter("leagueId", $league->getId())
                ->getQuery()
                ->getResult();
        }

        // Add the clubs home field with the properly data
        $form->add('club_id_home', EntityType::class, array(
            'placeholder' => 'Pierwsze wybierz ligę...',
            'class' => Clubs::class,
            'choices' => $clubs,
            'attr' => array('class' => 'form-control'),
            'label' => 'Drużyna gospodarzy:'
        ));

        // Add the clubs away field with the properly data
        $form->add('club_id_away', EntityType::class, array(
            'placeholder' => 'Pierwsze wybierz ligę...',
            'class' => Clubs::class,
            'choices' => $clubs,
            'attr' => array('class' => 'form-control'),
            'label' => 'Drużyna gości:'
        ));

    }

    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

        // Search for selected League and convert it into an Entity
        $league = $this->em->getRepository(League::class)->find($data['league_id']);

        $this->addElements($form, $league);
    }

    function onPreSetData(FormEvent $event) {
        $game = $event->getData();
        $form = $event->getForm();

        // When you create a new game, the League is always empty

        $league = $game->getLeagueId() ? $game->getLeagueId() : null;

        $this->addElements($form, $league);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Games::class
        ));
    }

}