<?php

namespace App\Controller\GeneralControllers;

use App\Entity\Games;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use CMEN\GoogleChartsBundle\GoogleCharts\Options\PieChart\PieSlice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StatisticController extends AbstractController{

    /**
     * @Route("/referee/statistic", methods = {"GET"}, name = "refereeStatistic")
     */
    public function RefereeGamesStatistic(Request $request){
        $this->denyAccessUnlessGranted('ROLE_REFEREE');

        $userId = $this->getUser()->getId();
        $games = $this->getDoctrine()->getRepository(Games::class)
            ->findAllByLeagueNameReferee($request, '', $userId);

        $yellowCards = 0;
        $redCards = 0;
        $penalties = 0;

        foreach ($games as $g){
            $yellowCards += $g->getYellowCards();
            $redCards += $g->getRedCards();
            $penalties += $g->getPenalties();
        }

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable(
            [['Żółte kartki', 'Czerwone kartki'],
                ['Żółte kartki', $yellowCards],
                ['Czerwone kartki', $redCards],
                ['Rzuty karne', $penalties],
            ]
        );
        $pieSlice1 = new PieSlice();
        $pieSlice1->setColor('yellow');
        $pieSlice2 = new PieSlice();
        $pieSlice2->setColor('red');
        $pieSlice3 = new PieSlice();
        $pieSlice3->setColor('green');

        $pieChart->getOptions()->setTitle('Statystki meczowe');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->setPieSliceText('value');
        $pieChart->getOptions()->setSlices([$pieSlice1, $pieSlice2, $pieSlice3]);

        return $this->render('/statistics/statistics.html.twig', array(
            'piechart' => $pieChart
        ));
    }

}