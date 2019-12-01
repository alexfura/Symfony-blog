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
            ->add('supplierName')
            ->add('supplierSecondName')
            ->add('supplierAddress')
            ->add('supplierPhone')
            ->add('supplierContract', EntityType::class, [
                'class' => Contracts::class,
                'choice_label' => 'contract_id'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Suppliers::class,
        ]);
    }
}
