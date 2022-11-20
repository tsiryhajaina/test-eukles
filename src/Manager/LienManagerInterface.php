<?php

namespace App\Manager;

use Symfony\Component\HttpFoundation\Request;

interface LienManagerInterface
{
    public function saveLink(Request $request);
}