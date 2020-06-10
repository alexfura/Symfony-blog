<?php

namespace App\Form;

use App\Entity\Contracts;
use App\Entity\Customers;
use App\Entity\Suppliers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContractsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contractPrice')
            ->add('contractSale')
            ->add('contractSignatureDate', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('contractSupplyDate', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('contractCustomer', EntityType::class, [
                'class' => Customers::class,
                'choice_label' => 'customerId'
            ])
            ->add('contractSupplier', EntityType::class, [
                'class' => Suppliers::class,
                'choice_label' => 'supplierId'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contracts::class,
        ]);
    }
}
