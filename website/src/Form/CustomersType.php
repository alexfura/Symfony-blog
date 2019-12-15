<?php

namespace App\Form;

use App\Entity\Contracts;
use App\Entity\Customers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customerFirstName')
            ->add('customerSecondName')
            ->add('customerPhone', TelType::class)
            ->add('customerContract', EntityType::class, [
                'class' => Contracts::class,
                'choice_label' => 'contract_id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Customers::class,
        ]);
    }
}
