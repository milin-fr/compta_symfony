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
        $allWorkTypes = $workTypeRepository->findAll();
        $allBills = $billRepository->findAll();

        $companies = [];
        $workTypes = [];

        foreach($allCompanies as $company){
            $provisionalSum = 0;
            $spentSum = 0;
            foreach($company->getBills() as $bill){
                if($bill->getStatus()->getTitle() == "Devis"){
                    $provisionalSum += $bill->getPrice();
                }
                if($bill->getStatus()->getTitle() == "Facturé"){
                    $spentSum += $bill->getPrice();
                }
            }
            $company->provisionalSum = $provisionalSum;
            $company->spentSum = $spentSum;
            $companies[] = $company;
        };

        foreach ($allWorkTypes as $workType) {
            $provisionalSum = 0;
            $spentSum = 0;
            foreach ($allBills as $bill) {
                if($bill->getCompany()->getWorkType() == $workType){
                    if($bill->getStatus()->getTitle() == "Devis"){
                        $provisionalSum += $bill->getPrice();
                    }
                    if($bill->getStatus()->getTitle() == "Facturé"){
                        $spentSum += $bill->getPrice();
                    }
                }
            }
            $workType->provisionalSum = $provisionalSum;
            $workType->spentSum = $spentSum;
            $workTypes[] = $workType;
        }

        return $this->render('home.html.twig', [
            'bills' => $billRepository->findAll(),
            'companies' => $companies,
            'workTypes' => $workTypes,
        ]);
    }
}
