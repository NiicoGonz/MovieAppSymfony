<?php

namespace App\Controller;


use App\Entity\Alquiler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Pelicula;
use App\Entity\Cliente;

class AlquilerController extends AbstractController
{

    public function index(): Response
    {

        $cliente_repo = $this->getDoctrine()->getRepository(Cliente::class);
        $clientes = $cliente_repo->findAll();

        return $this->render('alquiler/index.html.twig', [
            'clientes' => $clientes
        ]);
    }

    public function alquilarPelicula(Request $request)
    {
        $alquiler = new Alquiler();
        //$request->getSession()->clear();
        $data = $request->request->get('data');
        $em = $this->getDoctrine()->getManager();

        $cliente_repo = $this->getDoctrine()->getRepository(Cliente::class);
        $cliente = $cliente_repo->findOneBy(['id' => $data['cliente']]);

        $alquiler->setCliente($cliente);
        $alquiler->setFechaInicio(new \DateTime($data['fechaInicio']));
        $alquiler->setFechaFin(new \DateTime($data['fechaFin']));

        $valorPagar = 0;
        $peliculas = $request->getSession()->get('peliculas_alquiler');

        foreach ($peliculas as $pelicula) {
            $diasPrestamo = date_diff($alquiler->getFechaInicio(), $alquiler->getFechaFin());
            $valorPagar += $this->calcularValorPelicula($pelicula, $diasPrestamo);
        }
        $alquiler->setValorTotal($valorPagar);

        foreach ($peliculas as $pelicula) {
            $peliculaAux = $em->find(Pelicula::class, $pelicula->getId());
            $alquiler->addPelicula($peliculaAux);
        }
        $em->persist($alquiler);
        $em->flush();


        $request->getSession()->clear();
        return $this->redirectToRoute('gestionar_alquiler');
    }

    public function calcularValorPelicula(Pelicula $pelicula, $diasPrestamo)
    {
        $valorPagar = 0;

        if ($pelicula->getTipo() == 'nuevos') {

            $valorPagar += $diasPrestamo->days * $pelicula->getPrecioUnitario();

        } elseif ($pelicula->getTipo() == 'normales') {
            if ($diasPrestamo->days > 3) {
                $valorPagar += (($diasPrestamo->days - 3) * $pelicula->getPrecioUnitario() * 0.15)
                    + $pelicula->getPrecioUnitario();
            } else {
                $valorPagar += $pelicula->getPrecioUnitario();
            }
        } elseif ($pelicula->getTipo() == 'viejas') {
            if ($diasPrestamo->days > 5) {
                $valorPagar += (($diasPrestamo->days - 5) * $pelicula->getPrecioUnitario() * 0.10)
                    + $pelicula->getPrecioUnitario();
            } else {
                $valorPagar += $pelicula->getPrecioUnitario();
            }
        }
        return $valorPagar;
    }

    public function verAlquileres(): Response
    {
        $alquiler_repo = $this->getDoctrine()->getRepository(Alquiler::class);
        $alquileres = $alquiler_repo->findAll();

        return $this->render('alquiler/ver-alquileres.html.twig', [
            'alquileres' => $alquileres
        ]);
    }

    public function eliminarAlquiler(Alquiler $alquiler){
        if (!$alquiler) {
            return $this->verAlquileres();
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($alquiler);
        $em->flush();

        return $this->verAlquileres();
    }

    public function eliminarPelicula(Request $request, $id):Response{
        $session = $request->getSession();
        $peliculas = $session->get('peliculas_alquiler');
        foreach ( $peliculas as $key => $pelicula ){
            if($id == $key){
                unset($peliculas[$key]);
            }
        }
        $session->set('peliculas_alquiler' , $peliculas);

        return $this->index();
    }

    public function cancelarAlquiler(Request $request){
        $session = $request->getSession()->clear();

        return $this->index();
    }
}