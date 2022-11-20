<?php


namespace App\Manager;


use App\Factory\LinkFactoryInterface;
use App\Repository\LienRepository;
use Symfony\Component\HttpFoundation\Request;

class LienManager implements LienManagerInterface
{
    protected $linkFactory;
    protected $lienRepo;

    public function __construct(LinkFactoryInterface $linkFactory, LienRepository $lienRepo)
    {
        $this->linkFactory = $linkFactory;
        $this->lienRepo = $lienRepo;
    }

    /**
     * @param Request $request
     */
    public function saveLink(Request $request)
    {
        $datas = $this->linkFactory->prepareDatasToSave($request->request);
        return $this->lienRepo->add($datas, true);
    }
}