<?php


namespace App\Factory;


use App\Entity\Client;
use App\Entity\Lien;
use App\Entity\Materiel;
use Doctrine\ORM\EntityManagerInterface;

class LinkFactory implements LinkFactoryInterface
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param $datas
     * @return Lien
     */
    public function prepareDatasToSave($datas)
    {
        $link = new Lien();

        $idClient = $datas->get('client');
        if(!empty($idClient)) {
            $client = $this->em->getRepository(Client::class)->find($idClient);
            $link->setIdClient($idClient);
            $link->setClients($client);
        }

        $idMateriel = $datas->get('materiel');
        if(!empty($idMateriel)) {
            $link->setIdMateriel($idMateriel);
            $materiel = $this->em->getRepository(Materiel::class)->find($idMateriel);
            $link->setMateriels($materiel);
        }

        $link->setQuantite($datas->get('quantite'));
        $link->setPrixTotal($datas->get('prix_total'));

        return $link;
    }
}