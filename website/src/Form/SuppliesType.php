<?php

namespace App\Form;

use App\Entity\Contracts;
use App\Entity\Products;
use App\Entity\Supplies;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuppliesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('supplyQuantity')
            ->add('supplyProduct', EntityType::class, [
                'class' => Products::class,
                'choice_label' => 'productName'
            ])
            ->add('supplyContract', EntityType::class, [
                'class' => Contracts::class,
                'choice_label' => 'contract_id'
            ])
            ->add('supplyDate', DateTimeType::class, [
                'widget' => 'single_text',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Supplies::class,
        ]);
    }
}
