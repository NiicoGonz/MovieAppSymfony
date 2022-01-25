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

class AlquilerType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaInicio', DateType::class, array(
                'label' => 'Fecha Inicio:', 'label_attr' => ['class' => 'form-label'],
                'data' => new \DateTime("now")
            ))
            ->add('fechaFin', DateType::class, array(
                'label' => 'Fecha Fin:', 'label_attr' => ['class' => 'form-label'],
                'data' => new \DateTime("now")
            ))
            ->add('valorTotal', NumberType::class, array(
                'label' => 'Valor Total', 'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control']
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Guardar', 'attr' => ['class' => 'btn btn-success']
            ));
    }
}
