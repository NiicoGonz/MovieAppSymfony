<?php

namespace App\Controller;

use App\Entity\Pelicula;
use App\Form\AlquilerType;
use App\Form\PeliculaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Alquiler;
use App\Entity\Cliente;

class PeliculaController extends AbstractController
{
    /**
     * @Route("/pelicula", name="pelicula")
     */
    public function index(): Response
    {
        return $this->render('pelicula/index.html.twig', [
            'controller_name' => 'PeliculaController',
        ]);
    }


    public function verPelicula(){

        $em = $this->getDoctrine()->getManager();
        $pelicula_repo = $this->getDoctrine()->getRepository(Pelicula::class);
        $peliculas = $pelicula_repo->findAll();

        return $this->render('pelicula/ver-peliculas.html.twig',[
            'peliculas' => $peliculas
        ]);
    }

    public function  crearPelicula(Request $request){

        $pelicula = new Pelicula();
        $form = $this->createForm(PeliculaType::class, $pelicula);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
//            $pelicula->setPelicula($pelicula);

            $em = $this->getDoctrine()->getManager();
            $em->persist($pelicula);
            $em->flush();

            return $this->redirectToRoute('crear_pelicula');

        }

        return $this->render('pelicula/crear.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function editar(Request $request, Pelicula $pelicula){

        $form = $this->createForm(PeliculaType::class, $pelicula);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($pelicula);
            $em->flush();

            return $this->redirectToRoute('peliculas');
        }

        return $this->render('pelicula/editar.html.twig',[
            'form' => $form->createView()
        ]);
    }


    public function eliminar(Pelicula $pelicula){
        $em = $this->getDoctrine()->getManager();
        $em->remove($pelicula);
        $em->flush();

        return $this->redirectToRoute('peliculas');
    }

    public function crearAlquiler(Request $request)
    {
        $session = $request->getSession();

        $alquiler = new Alquiler();
        $form = $this->createForm(AlquilerType::class, $alquiler);
        $form->handleRequest($request);

        $cliente_repo = $this->getDoctrine()->getRepository(Cliente::class);
        $clientes = $cliente_repo->findBy([], ['id' => 'DESC']);

        $peliculas_repo = $this->getDoctrine()->getRepository(Pelicula::class);
        $peliculas_bd = $peliculas_repo->findBy([], ['id' => 'DESC']);


        if ($request->query->get('id')) {

            $var = $request->query->get('id');
            $pelicula = $peliculas_repo->find($var);

            if (!empty($session->get('peliculas_alquiler'))) {

                $count = $session->get('count');
                $count++;
                $session->set('count', $count);

                $peliculas = $session->get('peliculas_alquiler');
                $peliculas[$count] = $pelicula;
                $session->set('peliculas_alquiler', $peliculas);

            } else {
                $session->set('peliculas_alquiler', [1 => $pelicula]);
                $session->set('count', $i = 1);
            }
        }

        if (isset($count)) {
            $this->render('base.html.twig', [
                'count' => $count
            ]);
        }

        $this->render('alquiler/alquilar.html.twig', [
            'clientes' => $clientes,
            'peliculas' => $peliculas_bd,
        ]);

        return $this->verPelicula();
    }
}
