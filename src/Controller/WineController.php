<?php

namespace App\Controller;

use App\Entity\Region;
use App\Entity\Wine;
use App\Form\RegionType;
use App\Form\WineType;

use App\Repository\GrapeRepository;
use App\Repository\RegionRepository;
use App\Repository\VignobleRepository;

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
        $wine->setRegion($regionRepository->findOneBy(['id' => $resultForm['region']]));
        $wine->setVignoble($vignobleRepository->findOneBy(['id'=> $resultForm['vignoble']]));
        $entityManager->persist($wine);
        $entityManager->flush();

        return $this->render('wine/home.html.twig');

    }

    /**
     * @Route("/region", name="region")
     */
    public function region(Request $request, RegionRepository $regionRepository): Response
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
                'form' => $formNewWine->createView(),
                'region' => $region,
            ]);
        }

        return $this->render('wine/region.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/home", name="home")
     */
    public function start() : Response
    {
        return $this->render('wine/home.html.twig');
    }
}
