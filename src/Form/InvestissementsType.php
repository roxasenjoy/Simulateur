<?php

namespace App\Form;

use App\Entity\Investissements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvestissementsType extends AbstractType
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
            'data_class' => Investissements::class,
        ]);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'investMontant',
                IntegerType::class,
                [
                'label' => "Montant du crédit / mois",
                'attr' => [
                    'class' => 'investissement_input',
                    'placeholder' => 'Montant'
                ],
                "empty_data" => 0
            ])

            ->add(
                'investDuree',
                IntegerType::class,
                [
                'label' => "Durée restante ? (en année) ",
                'attr' => [
                    'class' => 'investissement_input',
                    'placeholder' => "Durée",
                ],
                "empty_data" => 0
            ])

            ->add(
                'investRente',
                IntegerType::class,
                [
                'label' => "Loyer perçu / mois",
                'attr' => [
                    'class' => 'investissement_input',
                     'placeholder' => "Loyer"
                ],
                "empty_data" => 0
            ])

            ->add(
                'investAchat',
                IntegerType::class,
                [
                    'label' => "Prix d'achat",
                    'attr' => [
                        'class' => 'investissement_input',
                        'placeholder' => "Prix"
                    ],
                    "empty_data" => 0
                ])
        ;
    }
}
