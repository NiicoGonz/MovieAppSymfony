<?php

namespace App\Controller;

use App\Entity\Alquiler;
use App\Entity\Cliente;
use App\Entity\Pelicula;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class AlquilerController extends AbstractController
{
    /**
     * @Route("/alquiler", name="alquiler")
     */
    public function index(): Response
    {
        $cliente_repo = $this->getDoctrine()->getRepository(Cliente::class);
        $clientes = $cliente_repo->findBy([], ['id' => 'DESC']);

        return $this->render('alquiler/alquilar.html.twig', [
            'clientes' => $clientes
        ]);
    }

    public function enviarAlquiler(Request $request)
    {

        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        $data = $request->request->get('data');

        $cliente_repo = $this->getDoctrine()->getRepository(Cliente::class);
        $cliente = $cliente_repo->find($data['cliente']);

        $peliculas = $session->get('peliculas_alquiler');

        $fechaInicio = new \DateTime($data['fechaInicio']);
        $fechaFin = new \DateTime($data['fechaFin']);
        $diasRestantes = date_diff($fechaInicio, $fechaFin);
        $dias = $diasRestantes->days;

        $alquiler = new Alquiler();
        $valorTotal = $alquiler->getCosteTotal($peliculas, $dias);

        $alquiler->setCliente($cliente);
        $alquiler->setValortotal($valorTotal);
        $alquiler->setValortotal($valorTotal);
        $alquiler->setFechainicio($fechaInicio);
        $alquiler->setFechafin($fechaInicio);

        if (is_object($alquiler)) {
            $this->guardarPeliculaAlquiler($peliculas, $alquiler);
            $this->guardarAlquiler($alquiler);
        }

        $session->clear();
        return $this->redirectToRoute('crear-alquiler');
    }

    public function guardarAlquiler(Alquiler $alquiler)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($alquiler);
        $em->flush();
    }

    public function guardarPeliculaAlquiler($peliculas, Alquiler $alquilerPelicula)
    {
        $em = $this->getDoctrine()->getManager();

        foreach ($peliculas as $indice) {
            $peli = $em->find(Pelicula::class, $indice->getId());
            $alquilerPelicula->addPelicula($peli);
        }
        $em->persist($alquilerPelicula);
        $em->flush();

    }

    public function verAlquiler()
    {
        $alquiler = new Alquiler();
        $alquiler_repo = $this->getDoctrine()->getRepository(Alquiler::class);
        $alquiler = $alquiler_repo->findAll();

        return $this->render('alquiler/ver-alquileres.html.twig', [
            'alquileres' => $alquiler
        ]);
    }

    public function editarAlquiler(Alquiler $alquiler)
    {
        $peliculas = $alquiler->getPeliculas();
        $cliente = $alquiler->getCliente();
        return $this->render('alquiler/editar-alquiler.html.twig', [
            'alquiler' => $alquiler,
            'cliente' => $cliente,
            'peliculas' => $peliculas
        ]);
    }

    public function eliminarCompra(Request $request)
    {
        $session = $request->getSession();
        $session->clear();

        return $this->redirectToRoute('crear-alquiler');
    }

    public function eliminarAlquiler(Alquiler $alquiler)
    {

        if (is_object($alquiler)) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($alquiler);
            $em->flush();
        }

        return $this->redirectToRoute('ver-alquileres');
    }

}
