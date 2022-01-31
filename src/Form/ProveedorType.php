<?php

namespace App\Form;

use App\Entity\Proveedor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProveedorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', null, ['label' => 'Nombre',])
            ->add('email', EmailType::class)
            ->add('telefono', null, ['label' => 'Teléfono',])
            ->add('tipo', ChoiceType::class, ['placeholder' => 'Elige una opción', 'choices'  => ['Hotel' => 'Hotel', 'Pista' => 'Pista', 'Complemento' => 'Complemento',],],)
            ->add('activo', ChoiceType::class, ['choices'  => ['Sí' => 'Sí', 'No' => 'No',],],);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Proveedor::class,
        ]);
    }
}
