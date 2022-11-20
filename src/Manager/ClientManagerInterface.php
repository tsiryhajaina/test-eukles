<?php


namespace App\Manager;


interface ClientManagerInterface
{

    public function getClient();

    public function getAllClients();

    public function getBestClients();

}