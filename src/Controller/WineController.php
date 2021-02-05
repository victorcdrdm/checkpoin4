<?php

namespace App\Controller;

use App\Entity\Region;
use App\Entity\Wine;
use App\Form\RegionType;
use App\Form\WineType;
use App\Repository\GrapeRepository;
use App\Repository\RegionRepository;
use App\Repository\VignobleRepository;
use App\Repository\WineRepository;
use Doctrine\ORM\EntityManagerInterface;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WineController extends AbstractController
{

    /**
     * @Route("/wine", name="wine")
     */
    public function index(Request $request,
                          EntityManagerInterface $entityManager,
                          VignobleRepository $vignobleRepository,
                          GrapeRepository $grapeRepository,
                          RegionRepository $regionRepository
                                                            ): Response
    {
        $region = new Region();
        $form = $this->createForm(RegionType::class , $region);
        $form->handleRequest($request);



        $wine = new Wine();

        $resultForm = $request->request->get('wine');

        foreach ( $resultForm['grapes'] as $grape) {
            $grape = $grapeRepository->findOneBy(['id' => $grape]);
            $wine->addGrape($grape);
        }

        $wine->setUserId($this->getUser());
        $wine->setName($resultForm['name']);
        $wine->setYear((int)$resultForm['year']['year']);
        $wine->setComment($resultForm['comment']);
        $wine->setPicture($resultForm['picture']);
        $wine->setRegion($regionRepository->findOneBy(['id' => $resultForm['region']]));
        $wine->setVignoble($vignobleRepository->findOneBy(['id'=> $resultForm['vignoble']]));
        $entityManager->persist($wine);
        $entityManager->flush();

        return $this->redirectToRoute('home');

    }

    /**
     * @Route("/", name="home")
     */
    public function start(WineRepository $wineRepository,
                          Request $request ,
                          RegionRepository $regionRepository) : Response
    {

        $region = new Region();
        $form = $this->createForm(RegionType::class , $region);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $region = $form->getData();
            $region = $regionRepository->findOneBy(['name' => $region->getName()]);
            $wine = new Wine();
            $formNewWine = $this->createForm(WineType::class , $wine, ['region' => $region ]);
            $formNewWine->handleRequest($request);
            return $this->render('wine/index.html.twig', [
                'formNew' => $formNewWine->createView(),
                'region' => $region,
            ]);
        }
            $regions = $regionRepository->findAll();
            $wines = $wineRepository->findAll();
            return $this->render('wine/home.html.twig',[
             'wines' => $wines,
             'regions' => $regions,
             'form' => $form->createView()
        ]);

    }
}
