<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 *
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function add(Client $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Client $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param integer $nbrMateriel
     * @param integer $totaux
     * @return Client[] Returns an array of Client objects
     */
    public function getClients($nbrMateriel = 0, $totaux = 0): array
    {
        return $this->createQueryBuilder('c')
            ->select('c.id, c.nomClient, c.prenomClient, c.adresseClient, COUNT(l.idMateriel) AS nbrMateriel, SUM(l.prixTotal) AS totaux')
            ->innerJoin('App\Entity\Lien', 'l', 'WITH', 'c.id = l.idClient')
            ->innerJoin('App\Entity\Materiel', 'm', 'WITH', 'm.id = l.idMateriel')
            ->andWhere('c.isActive = :active')
            ->setParameter('active', 1)
            ->groupBy('c.id')
            ->having('nbrMateriel >= :nbrmateriel')
            ->setParameter('nbrmateriel', $nbrMateriel)
            ->andHaving('totaux >= :totaux')
            ->setParameter('totaux', $totaux)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return int|mixed|string
     */
    public function getAllClients()
    {
        return $this->createQueryBuilder('c')
            ->select('c.id, c.nomClient, c.prenomClient')
            ->andWhere('c.isActive = :active')
            ->setParameter('active', 1)
            ->orderBy('c.nomClient', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @return Client[] Returns an array of Client objects
     */
    public function getBestClient(): array
    {
        $query = $this->createQueryBuilder('c')
            ->select('l.idClient, c.nomClient, c.prenomClient, COUNT(l.idMateriel) AS nbrMateriel, SUM(l.prixTotal) AS totaux')
            ->innerJoin('App\Entity\Lien', 'l', 'WITH', 'c.id = l.idClient')
            ->andWhere('c.isActive = :active')
            ->setParameter('active', 1)
            ->groupBy('l.idClient')
            ->orderBy('totaux', 'DESC')
            ->getQuery();

        return $query->getResult();
    }


}
