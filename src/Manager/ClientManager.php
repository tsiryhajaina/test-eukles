<?php


namespace App\Manager;


use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClientManager implements ClientManagerInterface
{

    protected $repoClient;
    const NBR_MATERIEL = 30;
    const TOTAUX = 30000;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->repoClient = $clientRepository;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->repoClient->getClients(self::NBR_MATERIEL, self::TOTAUX);
    }

    /**
     * @return int|mixed|string
     */
    public function getAllClients()
    {
        return $this->repoClient->getAllClients();
    }

    /**
     * @return Client[]
     */
    public function getBestClients()
    {
        return $this->repoClient->getBestClient();
    }
}