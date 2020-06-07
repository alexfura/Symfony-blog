<?php

namespace App\Form;

use App\Entity\Brands;
use App\Entity\Categories;
use App\Entity\Products;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productName')
            ->add('productManDate', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('productExpDate', DateTimeType::class, [
                'widget' => 'single_text',
            ])
            ->add('productCategory', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => 'categoryName'
            ])
            ->add('productBrand', EntityType::class, [
                'class' => Brands::class,
                'choice_label' => 'brandName',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
