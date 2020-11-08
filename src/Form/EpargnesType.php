<?php

namespace App\Form;

use App\Entity\Epargnes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EpargnesType extends AbstractType
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
            'data_class' => Epargnes::class
        ]);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('montant', ChoiceType::class,[
                "expanded" => true,
                "multiple" => false,
                'label' => 'A combien estimez-vous votre épargne?',
                "choices" => [
                    'Moins de 100€' => 0,
                    'Entre 100€ et 200€' => 100,
                    'Entre 200€ et 500€' => 200,
                    'Entre 500€ et 1000€' => 500,
                    'Plus de 1000€' => 1000,
                    ],

                'data' => 0
            ])
            ->add('apport', IntegerType::class,[
                'label' => "Quel serait le montant de cette apport ?",
                "required" => false,
                "attr" => [
                    'class' => "input",
                    'placeholder' => 'Montant'
                    ]
                ])

            ->add('reductionImpot', IntegerType::class, [
                'label' => "De combien réduisez vous votre impôt par an ?",
                "required" => false,
                "attr" => [
                    'class' => "input",
                    'placeholder' => 'Montant'
                    ]
                ])

            ->add('has_apport', ChoiceType::class, [
                'label' => 'Envisagez vous de mettre un apport dans votre investissement ? ',
                'attr' => [
                    'class' => "form",
                    'placeholder' => 'Montant'
                ],
                'choices' => [
                    'oui' => true,
                    'non' => false
                ],
                'data' => false,
                'mapped' => false,
                'expanded' => true,
            ])

            ->add('has_reductionImpot', ChoiceType::class, [
                'label' => 'Avez-vous déjà des réductions d\'impôts ?',
                'attr' => [
                    'class' => "form",
                    'placeholder' => 'Montant'
                ],
                'choices' => [
                    'oui' => true,
                    'non' => false
                ],
                'data' => false,
                'mapped' => false,
                'expanded' => true,
            ])
            ;
    }
}
