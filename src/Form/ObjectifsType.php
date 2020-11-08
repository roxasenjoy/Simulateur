<?php

namespace App\Form;

use App\Entity\Objectifs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjectifsType extends AbstractType
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
            'data_class' => Objectifs::class,
        ]);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('object1', ChoiceType::class, [
                'label' => 'Choisissez vos 3 objectifs principaux',
                "choices" => [
                    'Me créer un patrimoine immobilier' => "patrimoine",
                    'Anticiper ma retraite' => "retraite",
                    'Réduire ma fiscalité' => "fiscalite",
                    'Augmenter le rendement de mon épargne' => "rendement",
                    'Me constituer un capital' => "constitution",
                    'Transmettre à mes enfants' => "transmission",
                    'Obtenir un revenu complémentaire immédiat' => "rev_complementaire"
                ],
                "attr" => [
                    'class' => 'choice choice_objectif'
                ],

            ])
            ->add('object2', ChoiceType::class, [
                'label' => ' ',
                "choices" => [
                    'Me créer un patrimoine immobilier' => "patrimoine",
                    'Anticiper ma retraite' => "retraite",
                    'Réduire ma fiscalité' => "fiscalite",
                    'Augmenter le rendement de mon épargne' => "rendement",
                    'Me constituer un capital' => "constitution",
                    'Transmettre à mes enfants' => "transmission",
                    'Obtenir un revenu complémentaire immédiat' => "rev_complementaire"
                ],
                "attr" => [
                    'class' => 'choice choice_objectif'
                ]

            ])
            ->add('object3', ChoiceType::class, [
                'label' => ' ',
                "choices" => [
                    'Me créer un patrimoine immobilier' => "patrimoine",
                    'Anticiper ma retraite' => "retraite",
                    'Réduire ma fiscalité' => "fiscalite",
                    'Augmenter le rendement de mon épargne' => "rendement",
                    'Me constituer un capital' => "constitution",
                    'Transmettre à mes enfants' => "transmission",
                    'Obtenir un revenu complémentaire immédiat' => "rev_complementaire"
                ],
                "attr" => [
                    'class' => 'choice choice_objectif'
                ]

            ])
        ;
    }
}
