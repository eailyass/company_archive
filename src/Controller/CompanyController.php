<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/company', name: 'app_company_')]
class CompanyController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $companies = $doctrine->getRepository(Company::class)->findAll();
        return $this->render('company/index.html.twig', [
            'companies' => $companies,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, CompanyRepository $repo): Response
    {
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repo->add($company);
            $this->addFlash("success","Entreprise ajoutée avec succés");
            return $this->redirectToRoute("app_company_index");
        }
        return $this->render('company/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
