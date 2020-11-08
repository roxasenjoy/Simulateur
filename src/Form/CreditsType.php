<?php

namespace App\Form;

use App\Entity\Credits;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreditsType extends AbstractType
{
    /**
     * @return string
     */
    public function getBlockPrefix(): string
    {
        return '';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => Credits::class,
        ]);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('creditMontant',IntegerType::class,
                [
                    'label' => "Montant du crédit / mois",
                    'attr' => [
                        'class' => 'credit_input',
                        'placeholder' => "Montant",
                    ]

                ])

            ->add('creditDuree',IntegerType::class,
                [
                    'label' => "Durée restante ? (en année)",
                    'attr' => [
                        'class' => 'credit_input',
                        'placeholder' => "Durée",
                    ]
                ])
        ;
    }
}
