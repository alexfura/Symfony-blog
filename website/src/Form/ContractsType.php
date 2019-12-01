<?php

namespace App\Form;

use App\Entity\Contracts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContractsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contractPrice')
            ->add('contractSale')
            ->add('contractSignatureDate')
            ->add('contractSupplyDate')
            ->add('contractCustomers')
            ->add('contractSuppliers')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contracts::class,
        ]);
    }
}
