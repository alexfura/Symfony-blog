<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name')
            ->add('second_name')
            ->add('birth_date')
//            ->add('headshot', FileType::class,
//                [
//                    'label' => 'Image',
//                    'mapped' => false,
//                    'required' => false,
//                    'constraints' => [
//                        'maxSize' => '4M',
//                        'mimeTypes' => [
//                            'image/*'
//                        ]
//                    ]
//                ]
//            )
        ->add('save', SubmitType::class, ['label' => 'Save']);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
