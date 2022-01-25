<?php

namespace App\Controller;

use App\Entity\Pelicula;
use App\Form\PeliculaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PeliculaController extends AbstractController
{

    public function index(): Response
    {

        $em = $this->getDoctrine()->getManager();
        $peliculas_repo = $this->getDoctrine()->getRepository(Pelicula::class);
        $peliculas = $peliculas_repo->findAll();

        return $this->render('pelicula/index.html.twig', [
            'peliculas' => $peliculas,
        ]);
    }

    public function crearPelicula(Request $request ){

        $pelicula = new Pelicula();
        $form = $this->createForm(PeliculaType::class, $pelicula);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($pelicula);
            $em->flush();

            return $this->redirectToRoute('peliculas');
        }

        return $this->render('pelicula/crear.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function eliminarPelicula(Pelicula $pelicula){

        if (!$pelicula){
            return $this->redirectToRoute('peliculas');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($pelicula);
        $em->flush();
        return $this->redirectToRoute('peliculas');
    }

    public function editarPelicula(Request $request , Pelicula $pelicula){

        $form = $this->createForm(PeliculaType::class , $pelicula);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($pelicula);
            $em->flush();

            return $this->redirectToRoute('peliculas');
        }

        return $this->render('pelicula/crear.html.twig', [
            'form' => $form->createView(),
            'editar' => true
        ]);
    }


}
