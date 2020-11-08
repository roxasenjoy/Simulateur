<?php

namespace App\Form;


use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'firstname',
                TextType::class,
                    [
                    'label' => ' ',
                    'attr' => [
                        'class' => 'field',
                        'placeholder' => 'PRÉNOM'
                        ]
                    ])

            ->add('lastname',
                TextType::class,
                    [
                    'label' => ' ',
                    'attr' => [
                        'class' => 'field',
                        'placeholder' => 'NOM'
                        ]
                    ])
            ->add('email', EmailType::class,
                [
                'label' => ' ',
                'attr' => [
                    'class' => 'field',
                    'placeholder' => 'E-MAIL'
                    ]
                ])
            ->add('object', TextType::class,
                [
                'label' => ' ',
                'attr' => [
                    'class' => 'field',
                    'placeholder' => 'OBJET'
                    ]
                ])
            ->add('message', TextareaType::class,
                [
                'label' => ' ',
                'attr' => [
                    'class' => 'textArea',
                    'placeholder' => 'VOTRE MESSAGE...',
                    'rows' => '5',
                    'cols' => '50',
                    ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
