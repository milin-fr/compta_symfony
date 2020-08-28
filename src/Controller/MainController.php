<?php

namespace App\Controller;

use App\Entity\Bill;
use App\Form\BillType;
use App\Repository\BillRepository;
use App\Repository\CompanyRepository;
use App\Repository\WorkTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function home(CompanyRepository $companyRepository, WorkTypeRepository $workTypeRepository, BillRepository $billRepository): Response
    {

        $allCompanies = $companyRepository->findAll();

        $companies = [];

        foreach($allCompanies as $company){
            $provisionalEuroSum = 0;
            $provisionalCentSum = 0;
            $spentEuroSum = 0;
            $spentCentSum = 0;
            foreach($company->getBills() as $bill){
                if($bill->getStatus()->getTitle() == "Devis"){
                    $provisionalEuroSum += $bill->getPriceEuro();
                    $provisionalCentSum += $bill->getPriceCent();
                }
                if($bill->getStatus()->getTitle() == "Facturé"){
                    $spentEuroSum += $bill->getPriceEuro();
                    $spentCentSum += $bill->getPriceCent();
                }
            }
            $provisionalEuroSum += intdiv($provisionalCentSum, 100);
            $provisionalCentSum = $provisionalCentSum % 100;
            $company->provisionalEuroSum = $provisionalEuroSum;
            $company->provisionalCentSum = $provisionalCentSum;

            $spentEuroSum += intdiv($spentCentSum, 100);
            $spentCentSum = $spentCentSum % 100;
            $company->spentEuroSum = $spentEuroSum;
            $company->spentCentSum = $spentCentSum;
            $companies[] = $company;
        };

        return $this->render('home.html.twig', [
            'bills' => $billRepository->findAll(),
            'companies' => $companies,
        ]);
    }
}
