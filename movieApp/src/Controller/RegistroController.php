<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RegistroController extends AbstractController
{
    
    public function index()
    {
        return $this->render('registro/index.html.twig', [
            'controller_name' => 'RegistroController',
        ]);
    }
}
