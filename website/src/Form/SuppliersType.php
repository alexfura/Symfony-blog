<?php

namespace App\Form;

use App\Entity\Contracts;
use App\Entity\Suppliers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuppliersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('supplierFirstName')
            ->add('supplierSecondName')
            ->add('supplierAddress')
            ->add('supplierPhone')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Suppliers::class,
        ]);
    }
}
