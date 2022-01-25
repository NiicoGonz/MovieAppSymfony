<?php

namespace App\Controller;

use App\Entity\Alquiler;
use App\Entity\AlquilerPelicula;
use App\Entity\Cliente;
use App\Entity\Pelicula;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AlquilerController extends AbstractController
{


    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $alquileres_repo = $this->getDoctrine()->getRepository(Alquiler::class);
        $alquileres = $alquileres_repo->findAll();

        return $this->render('alquiler/index.html.twig', [
            'alquileres' => $alquileres,
        ]);
    }

    public function alquilar(Pelicula $pelicula){
        var_dump($pelicula);



        return $this->render( 'alquiler/alquilerPelicula.html.twig' ,[

        ]);
    }

    public function agregarID(Request $request){


        if($request->query->get('id')) {

        $id = $request->query->get('id');
        $peliculas_repo = $this->getDoctrine()->getRepository(Pelicula::class);
        $pelicula = $peliculas_repo->find($id);
        $peliculas = null;



        $session = $request->getSession();


            if (!empty($session->get('peliculas_alquiler'))) {

                $count = $session->get('count');
                $count++;
                $session->set('count', $count);

                $peliculas = $session->get('peliculas_alquiler');

                $peliculas[$count] = $pelicula;

                $session->set('peliculas_alquiler', $peliculas);
            } else {
                $session->set('peliculas_alquiler', [0 => $pelicula]);
                $session->set('count', $i = 0);
            }
           // $session->clear();
        }
        $em = $this->getDoctrine()->getManager();
        $cliente_repo = $this->getDoctrine()->getRepository(Cliente::class);
        $clientes = $cliente_repo->findAll();

        return $this->render( 'alquiler/alquilerPelicula.html.twig' ,[
            'clientes' => $clientes,
        ]);
    }

    public function crearAlquiler(Request $request){

        $data = $request->request->get('data');
        $session = $request->getSession();
        $valorTotal = 0;

        $peliculas = $session->get('peliculas_alquiler');

        foreach ($peliculas as $pelicula){
            $valorTotal += $this->valorAlquilerPelicula($pelicula , $data['fecha_inicio'], $data['fecha_fin']);
        }

        $alquiler = new Alquiler();

        $em = $this->getDoctrine()->getManager();

        $cliente_repo = $this->getDoctrine()->getRepository(Cliente::class);
        $cliente = $cliente_repo->find($data['cliente']);
        $alquiler->setIdCliente($cliente);
        $alquiler->setValorTotal($valorTotal);
        $alquiler->setFechaInicio(new \DateTime($data['fecha_inicio']));
        $alquiler->setFechaFin(new \DateTime($data['fecha_fin']));


        echo '<script language="javascript">alert("'.$valorTotal.'");</script>';
        $em->persist($alquiler);
        $em->flush();



        var_dump($peliculas);
        foreach ($peliculas as $pelicula){
            //$peliculaAux = new Pelicula();
            //$peliculaAux = $pelicula;
            $alquilerPelicula = new AlquilerPelicula();
            $peliculaAux = $em->find(Pelicula::class, $pelicula->getId());
            $alquilerPelicula->setIdPelicula($peliculaAux);
            $alquilerPelicula->setIdAlquiler($alquiler);
            $em = $this->getDoctrine()->getManager();
            $em->persist($alquilerPelicula);
            $em->flush();
        }


        $session->clear();
        return $this->redirectToRoute('peliculas');

    }

    public function eliminarPeliculaPreAlquiler(Request $request, $id){

        $session = $request->getSession();

        $peliculas = $session->get('peliculas_alquiler');

        foreach ( $peliculas as $key => $pelicula ){

            if($id == $key){

                unset($peliculas[$key]);
            }
        }

        $session->set('peliculas_alquiler' , $peliculas);

        $em = $this->getDoctrine()->getManager();
        $cliente_repo = $this->getDoctrine()->getRepository(Cliente::class);
        $clientes = $cliente_repo->findAll();

        return $this->render( 'alquiler/alquilerPelicula.html.twig' ,[
            'clientes' => $clientes,
        ]);

    }

    public function valorAlquilerPelicula(Pelicula $pelicula, $fecha_inicio , $fecha_fin){

        $inicio = (new \DateTime($fecha_inicio));
        $fin = (new \DateTime($fecha_fin));
        $diasPrestamo = date_diff($inicio, $fin);

        $valorTotal = 0;

        if($pelicula->getTipo() == "nuevos_lanzamientos"){
            $valorTotal = $diasPrestamo->days * $pelicula->getPrecioUnitario();

        }elseif ($pelicula->getTipo() == "pelicula_normal"){
            if ($diasPrestamo->days >3){
                $valorTotal = (($diasPrestamo->days -3 ) * $pelicula->getPrecioUnitario() * 0.15 ) +
                    $pelicula->getPrecioUnitario();
            }else{
                $valorTotal= $pelicula->getPrecioUnitario();
            }

        }elseif($pelicula->getTipo() == "pelicula_vieja"){
            if ($diasPrestamo->days >5){
                $valorTotal = (($diasPrestamo->days -5 ) * $pelicula->getPrecioUnitario() * 0.10 ) +
                    $pelicula->getPrecioUnitario();
            }else{
                $valorTotal= $pelicula->getPrecioUnitario();
            }

        }
        return $valorTotal;
    }

    public function eliminarAlquiler(Alquiler $alquiler){

        if (!$alquiler){
            return $this->redirectToRoute('alquiler');
        }
        $em = $this->getDoctrine()->getManager();

        $alquiler_pelicula_repo = $this->getDoctrine()->getRepository(AlquilerPelicula::class);
        $alquileres_peliculas = $alquiler_pelicula_repo->findBy([
            'idAlquiler' => $alquiler->getId()
        ]);

        foreach ($alquileres_peliculas as $alquilerAux){
            $em->remove($alquilerAux);
            $em->flush();
        }

        $em->remove($alquiler);
        $em->flush();
        return $this->redirectToRoute('alquiler');
    }

}
