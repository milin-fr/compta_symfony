<?php

namespace App\Controller;

use App\Entity\Bill;
use App\Entity\Company;
use App\Entity\WorkType;
use App\Form\BillType;
use App\Repository\BillRepository;
use App\Repository\CompanyRepository;
use App\Repository\WorkTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/bill", name="bill_post", methods={"POST"})
     */
    public function billPost(Request $request, WorkTypeRepository $workTypeRepository, CompanyRepository $companyRepository, EntityManagerInterface $em)
    {
        $contentObject = json_decode($request->getContent());
        $workTypeTitle = $contentObject->workTypeTitle;
        $companyTitle = $contentObject->companyTitle;
        $workType = $workTypeRepository->findOneBy(['title' => $workTypeTitle]);
        $company = $companyRepository->findOneBy(['title' => $companyTitle]);
        $billDescription = $contentObject->billDescription;
        $billEuro = $contentObject->billEuro;
        $billCent = $contentObject->billCent;
        if(!$workType){ // si le nom de type de charge n'est pas trouvé en BD, on va le creer
            $workType = new WorkType();
            $workType->setTitle($workTypeTitle);
            $em->persist($workType);
        }
        if(!$company){ // si le nom de l'entreprise n'est pas trouvé en BD, on va le creer
            $company = new Company();
            $company->setTitle($companyTitle);
            $company->setWorkType($workType);
            $em->persist($company);
        }
        $bill = new Bill();
        $bill->setDescription($billDescription);
        $bill->setCompany($company);
        $bill->setPriceEuro($billEuro);
        $bill->setPriceCent($billCent);
        $em->persist($bill);
        $em->flush();
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/work-type/company", name="company_get_by_work_type", methods={"POST"})
     */
    public function companyGetByWorkType(Request $request, CompanyRepository $companyRepository, WorkTypeRepository $workTypeRepository)
    {
        $contentObject = json_decode($request->getContent());
        $workTypeTitle = $contentObject->workTypeTitle;
        $workType = $workTypeRepository->findOneBy(['title' => $workTypeTitle]);
        $companies = $workType->getCompanies();
        return $this->json($companies, 200, [], ['groups' => 'get:company']);
    }
}
