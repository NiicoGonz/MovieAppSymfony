<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class PeliculaType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre', TextType::class, [
            'label' => 'Nombre', 'label_attr' => ['class' => 'form-label'],
            'attr' => ['class' => 'form-control mb-2']])
            ->add('sinopsis', TextareaType::class, [
                'label' => 'Sinopsis', 'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control mb-2']])
            ->add('precio_unitario', TextType::class, [
                'label' => 'Precio unitario', 'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control mb-2']])
            ->add('tipo', ChoiceType::class, [
                'label' => 'Tipo', 'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-select mb-2'], 'choices' => ['Nuevos lanzamientos' => 'nuevos',
                    'Películas normales' => 'normales', 'Películas viejas' => 'viejas'],
                'choice_attr' => ['form-select'] ])
            ->add('genero', TextType::class, [
                'label' => 'Genero', 'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control mb-2']])
            ->add('fecha_estreno', DateType::class, [
                'label' => 'Fecha estreno', 'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control mb-2']])
            ->add('submit', SubmitType::class,
                ['label' => 'Guardar', 'attr' => ['class' => 'btn  btn-success']
                ]);
    }


}