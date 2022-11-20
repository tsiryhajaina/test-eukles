<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Manager\ClientManagerInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_client")
     */
    public function index(ClientManagerInterface $clientManager): Response
    {
        $clients = $clientManager->getClient();
        $renderData['clients'] = $clients;
        return $this->render('home/index.html.twig', $renderData);
    }
}
