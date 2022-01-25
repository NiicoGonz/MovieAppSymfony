<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PeliculaType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class, array(
            'label' => 'Nombre' , 'label_attr' => ['class'=>"form-label"] ,
            'attr' => ['class' => "form-control"]
        ))
            ->add('sinopsis', TextareaType::class, array(
                'label' => 'Sinopsis' ,'label_attr' => ['class'=>"form-label"] ,
                'attr' => ['class' => "form-control"]
            ))
            ->add('precio_unitario' , NumberType::class,array(
                'label' => 'Precio Unitario' ,'label_attr' => ['class'=>"form-label"] ,
                'attr' => ['class' => "form-control"]
            ))
            ->add('tipo', ChoiceType::class, array(
                'label' => 'Tipo' ,
                'choices' => array(
                    'Nuevos Lanzamiento' => 'nuevos_lanzamientos',
                    'Pelicula Normal' => 'pelicula_normal',
                    'Pelicula Vieja' =>'pelicula_vieja'
                )
                ,'label_attr' => ['class'=>"form-label"] ,
                'attr' => ['class' => "form-control"]
            ))
            ->add('genero', TextType::class, array(
                'label' => 'Genero' ,'label_attr' => ['class'=>"form-label"] ,
                'attr' => ['class' => "form-control"]
            ))
            ->add('fecha_estreno', DateType::class, array(
                'label' => 'Fecha De Estreno' ,'label_attr' => ['class'=>"form-label"] ,
                'attr' => ['class' => "form-control"]
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Guardar' , 'attr'=>[ 'class' => 'btn btn-secondary'] ,
            ));
    }

}