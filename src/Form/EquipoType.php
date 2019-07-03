<?php
// src/Form/TaskType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;


class EquipoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categoria')
            ->add('sexo', ChoiceType::class, [
                'choices'  => [
                    'Masculino' => 'masculino',
                    'Femenino' => 'femenino',
                    'Mixto' => 'mixto'
                ],
            ])
            ->add('numjugadores')
            ->add('salvar', SubmitType::class, ['label' => 'Crear equipo'])
        ;
    }
}