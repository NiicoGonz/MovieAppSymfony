<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PeliculaType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('nombre', TextType::class, array(
            'label' => 'Nombre', 'label_attr' => ['class' => 'form-label'],
            'attr' => ['class' => 'form-control']
        ))
            ->add('sipnosis', TextareaType::class, array(
                'label' => 'Sipnopsis', 'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ))
            ->add('precioUnitario', NumberType::class, array(
                'label' => 'Precio Unitario', 'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ))
            ->add('tipo', ChoiceType::class, array(
                'label' => 'Tipo de Pelicula',
                'choices' => array(
                    'Nuevos Lanzamientos' => 'nuevo',
                    'Peliculas normales' => 'normal',
                    'Peliculas viejas' => 'viejo'
                ), 'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-select']
            ))
            ->add('genero', TextType::class, array(
                'label' => 'Genero', 'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ))
            ->add('fechaEstreno', DateType::class, array(
                'label' => 'Fecha Estreno:', 'label_attr' => ['class' => 'form-label'],
                'help_attr' => ['class' => 'form-control']
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Guardar', 'attr' => ['class' => 'm-2 btn btn-success']
            ));
    }
}