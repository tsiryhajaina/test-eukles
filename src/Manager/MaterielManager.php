<?php


namespace App\Manager;


use App\Repository\MaterielRepository;

class MaterielManager implements MaterielManagerInterface
{

    protected $repoMateriel;

    public function __construct(MaterielRepository $materielRepository)
    {
        $this->repoMateriel = $materielRepository;
    }

    public function getAllMateriels()
    {
        return $this->repoMateriel->getAllMateriels();
    }
}