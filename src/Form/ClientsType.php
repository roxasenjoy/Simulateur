<?php

namespace App\Form;

use App\Entity\Clients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientsType extends AbstractType
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
            'data_class' => Clients::class,
        ]);

        $resolver->setRequired('step');
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options){

        $step = $options['step'];

        if($step === 5){
           $builder->add('nom', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'class' => 'input lastname',
                    'placeholder' => "Nom",
                    'novalidate' => 'novalidate'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => ' ',
                'attr' => [
                    'class' => 'input firstname',
                    'placeholder' => "Prénom",
                ]
            ])
            ->add('email', EmailType::class,[
                'label' => ' ',
                'attr' => [
                    'class' => 'input email',
                    'placeholder' => "Adresse email",
                ]
            ])
            ->add('codePostal', IntegerType::class,[
                'label' => ' ',
                'attr' => [
                    'class' => 'input',
                    'placeholder' => "Code Postal",
                ]
            ])
            ->add('telephone', IntegerType::class, [
                'label' => ' ',
                'attr' => [
                    'class' => 'input telephone',
                    'placeholder' => "Numéro de téléphone",
                ]
            ])

           ->add('telephonePays', IntegerType::class, [
               'label' => ' ',
               'attr' => [
                   'class' => 'input telephone',
                   'placeholder' => "33",
               ]
           ])

            ->add('condGenerales', CheckboxType::class,[
                'label' => 'Vous confirmez avoir pris connaissance et acceptez nos conditions générales. ',
                'empty_data' => false,
                'attr' => [
                    'class' => 'condition',
                ]
            ])
           ;
        }



            if($step === 1){
                $builder->add('situations', SituationsType::class);
            }

            if($step === 2){
                $builder->add('patrimoines', PatrimoinesType::class, [
                    "error_bubbling" => false,
                ]);
            }

            if($step === 3){
                $builder->add('epargnes', EpargnesType::class);
            }

            if($step === 4){
                $builder->add('objectifs', ObjectifsType::class);
            }
        ;
    }
}
