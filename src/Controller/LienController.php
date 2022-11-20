<?php

namespace App\Controller;

use App\Manager\ClientManagerInterface;
use App\Manager\LienManagerInterface;
use App\Manager\MaterielManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LienController extends AbstractController
{
    /**
     * @Route("/materiel-clients", name="app_lien")
     */
    public function index(ClientManagerInterface $clientManager, MaterielManagerInterface $materielManager): Response
    {
        $allClients = $clientManager->getAllClients();
        $allMateriels = $materielManager->getAllMateriels();

        $renderDatas['clients'] = $allClients;
        $renderDatas['materiels'] = $allMateriels;
        return $this->render('lien/index.html.twig', $renderDatas);
    }

    /**
     * @Route("/save-materiel-clients", name="app_save_lien")
     *
     * @param Request $request
     */
    public function saveLink(Request $request, LienManagerInterface $lienManager)
    {
        dd($request);
        $lienManager->saveLink($request);

        $newSave = $request->request->get('enregistrerNouveau') ?? null;
        if(!is_null($newSave)){
            return $this->redirectToRoute('app_lien');
        }

        return $this->redirectToRoute('app_best_client');
    }

    /**
     * @Route("/calcul-clients", name="app_best_client")
     *
     * @param ClientManagerInterface $clientManager
     * @return Response
     */
    public function showBestClient(ClientManagerInterface $clientManager)
    {
        $bestClient = $clientManager->getBestClients();
        $renderDatas['clients'] = $bestClient;

        return $this->render('lien/best-clients.html.twig', $renderDatas);
    }
}
