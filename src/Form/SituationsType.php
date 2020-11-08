<?php

namespace App\Form;

use App\Entity\Situations;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class SituationsType extends AbstractType
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
            'data_class' => Situations::class,
        ]);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('famille', ChoiceType::class, [
                'label' => 'Votre situation familiale ?',
                "choices" => [
                    'Célibataire' => "celibataire",
                    'Marié(e)' => "marie",
                    'Pascé(e)' => "pasce",
                    'Concubinage' => "concubinage",
                    'Divorcé(e)' => "divorce",
                    'Veuf / Veuve' => "veuf",
                    ],

                'choice_attr' => function($choice, $key, $value) {
                    // adds a class like attending_yes, attending_no, etc
                    return ['class' => 'input'];
                },

                'data' => 'celibataire',
                "multiple" => false,
                "expanded" => true,
            ])

            ->add('naissance', IntegerType::class, [
                'label' => "Votre date de naissance ?",
                "attr" => [
                    'class' => 'input',
                    'placeholder' => 'Ex: 1978'
                    ],
                'constraints' => [new Length(['min' => 3])],
                ])
            ->add('enfant',IntegerType::class, [
                'label' => "Combien avez-vous d'enfants ?",
                "required" => false,
                "attr" => [
                    'class' => 'input',
                    'placeholder' => 'Ex: 2',
                    ],

                ])

            ->add('enfantFiscal',NumberType::class, [
                'label' => "Quel est votre nombre de parts fiscales ?",
                "attr" => [
                    'class' => 'input',
                    'placeholder' => 'Montant'
                    ],

                ])

            ->add('pension',IntegerType::class, [
                'label' => "Combien coûte cette pension mensuellement ?",
                "required" => false,
                "attr" => [
                    'class' => 'input',
                    'placeholder' => 'Montant'
                    ],
                ])

            ->add('has_pension', ChoiceType::class, [
                'label' => 'Versez-vous une pension ?',
                'attr' => [
                    'class' => "form"
                ],
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'data' => false,
                'required' => false,
                'placeholder' => false,
                'mapped' => false,
                'expanded' => true,
            ])

            ->add('has_enfant', ChoiceType::class, [
                'label' => 'Avez vous des enfants ?',
                'attr' => [
                  'class' => "form"
                ],
                'choices' => [
                    'Oui' => true,
                    'Non' => false
                ],
                'data' => false,
                'required' => false,
                'placeholder' => false,
                'mapped' => false,
                'expanded' => true,
            ])
        ;
    }
}
