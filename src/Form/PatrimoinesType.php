<?php

namespace App\Form;

use App\Entity\Patrimoines;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatrimoinesType extends AbstractType
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
            'data_class' => Patrimoines::class,
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
                'bail',
                ChoiceType::class,
                    [
                        "expanded" => true,
                        "multiple" => false,
                        'label' => 'Concernant votre résidence principale vous êtes :',
                        'attr' => [
                            'class' => "form",
                            'onClick' => "showAnswer()"
                        ],
                        "choices" => [
                            'Propriétaire' => "proprietaire",
                            'Locataire' => "locataire",
                            'Hébergé gratuitement' => "gratuit"
                            ],

                        'data' => 'gratuit'
                    ])

            /* Pas dans l'entity */
            ->add(
                'credit_proprio',
                ChoiceType::class,
                    [
                        'label' =>'Avez vous un crédit sur la résidence principale ? ',
                        'attr' => [
                            'class' => "form",
                        ],
                        'choices' => [
                            "oui" => true,
                            "non" => false
                        ],
                        'data' => false,
                        'mapped' => false,
                        'expanded' => true,
                        'required' => false,
                        'placeholder' => false
                ])

            ->add(
                'proprioCredit',
                IntegerType::class,
                    [
                        'label' => 'Combien vous coûte ce crédit par mois ?',
                        "required" => false,
                        "attr" => [
                            'class' => 'input',
                            'placeholder' => 'Montant'
                        ],
                        'mapped' => true,

                    ])

            ->add(
                'proprioDuree',
                IntegerType::class,
                    [
                        'label' => 'Quelle est la durée restante (en année) ?',
                        "required" => false,
                        "attr" => [
                            'class' => 'input',
                            'placeholder' => 'Durée'
                        ],
                        'mapped' => true,
                    ])

            ->add(
                'locaLoyer',
                IntegerType::class,
                    [
                        'label' => 'Montant de votre loyer',
                        "required" => false,
                        "attr" => [
                            'class' => 'input',
                        ],
                        'mapped' => true,
                    ])

            ->add(
                'revenuFoyer',
                IntegerType::class,
                    [
                        'label' => 'Quel est le revenu net ANNUEL de votre foyer ?',
                        "attr" => [
                            'class' => 'input',
                            'placeholder' => 'Montant'
                            ]
                    ])


            /************* INVESTISSEMENT SUPPLEMENTAIRE *************************/
            ->add(
                'proprio_loc',
                ChoiceType::class,
                    [
                        'label' =>'Avez vous déjà un investissement locatif en cours ? ',
                        'attr' =>[
                            'class' => 'form',
                            'onClick' => "showAnswer()",
                        ],
                        'choices' => [
                            "oui" => true,
                            "non" => false
                        ],
                        'data' => false,
                        'mapped' => false,
                        'expanded' => true,
                    ])

            ->add(
                'investissements',
                CollectionType::class,
                [
                    'entry_type' => InvestissementsType::class,
                    'allow_add' => true,
                    'allow_delete'=>true,
                    'by_reference' => false,
                    "error_bubbling" => false,
                ])

            /************* CREDITS SUPPLEMENTAIRE *************************/
            ->add(
                'has_credits',
                ChoiceType::class,
                [
                    'label' =>'Avez-vous des crédits? (Autres qu\'immobilier) ',
                    'attr' => [
                        'class' => "form",
                        'onClick' => "showAnswer()",
                    ],
                    'choices' => [
                        "oui" => true,
                        "non" => false
                    ],
                    'data' => false,

                    'mapped' => false,
                    'expanded' => true,
                ])

            ->add(
                'credits',
                CollectionType::class,
                [
                    'entry_type' => CreditsType::class,
                    'allow_add' => true,
                    'allow_delete'=>true,
                    'by_reference' => false,
                    "error_bubbling" => false,
                ])

            /************************** Test ********************************/
            ;
    }
}
