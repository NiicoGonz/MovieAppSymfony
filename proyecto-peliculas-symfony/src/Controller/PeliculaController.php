<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Pelicula;
use App\Form\PeliculaType;

class PeliculaController extends AbstractController{

    public function index(): Response
    {
        $pelicula_repo = $this->getDoctrine()->getRepository(Pelicula::class);
        $peliculas = $pelicula_repo->findAll();

        return $this->render('pelicula/index.html.twig', [
            'peliculas' => $peliculas
        ]);
    }

    public function crearPeliculas(Request $request): Response
    {
        $pelicula = new Pelicula();
        $form = $this->createForm(PeliculaType::class, $pelicula);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pelicula);
            $em->flush();

            return $this->redirectToRoute('gestionar_peliculas');
        }

        return $this->render('pelicula/crear-pelicula.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function gestionarPeliculas()
    {
        $pelicula_repo = $this->getDoctrine()->getRepository(Pelicula::class);
        $peliculas = $pelicula_repo->findAll();


        return $this->render('pelicula/gestionar-peliculas.html.twig', [
            'peliculas' => $peliculas
        ]);
    }

    public function editarPelicula(Request $request, Pelicula $pelicula)
    {

        $form = $this->createForm(PeliculaType::class, $pelicula);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($pelicula);
            $em->flush();

            return $this->redirectToRoute('gestionar_peliculas');
        }

        return $this->render('pelicula/crear-pelicula.html.twig', ['edit' => true, 'form' => $form->createView()]);
    }

    public function eliminarPelicula(Pelicula $pelicula){
        if (!$pelicula) {
            return $this->redirectToRoute('gestionar_peliculas');
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($pelicula);
        $em->flush();

        return $this->redirectToRoute('gestionar_peliculas');
    }

    public function agregarPeliculaAlquiler(Request $request, Pelicula $pelicula){
        $session = $request->getSession();
//        $session->clear();
        if(!empty($session->get('peliculas_alquiler'))){

            $count = $session->get('count');
            $count ++;
            $session->set('count', $count);

            $peliculas = $session->get('peliculas_alquiler');
            $peliculas[$count] = $pelicula;
            $session->set('peliculas_alquiler', $peliculas);

            $totalPagar = $session->get('totalPagar');
            $totalPagar += (int) $pelicula->getPrecioUnitario();
            $session->set('totalPagar', $totalPagar);
        }else{
            $session->set('peliculas_alquiler', [0 => $pelicula ]);
            $session->set('count', 0);
            $session->set('totalPagar', $pelicula->getPrecioUnitario());
        }

            return $this->index();
    }

}
