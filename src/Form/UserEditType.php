<?php

namespace App\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class , array(
                            'label' => 'Nom',
                            'attr' => array('class'=>"default")
                            ))
                ->add('lastname', TextType::class, array(
                            'label' => 'Prenom',
                            'attr' => array('class'=>"default")
                            ))
                
                ->add('datenaissance',DateType::class, array(
                        'widget' => 'single_text',
                        'label' =>'Date de naissance',
                       'required' => false,                    
                        ))



                ->add('adresse', TextType::class, array(
                    'label' => 'Adresse',
                    'required' => false,

                    'attr' => array('class'=>"default")
                ))
                ->add('pays', EntityType::class, array(
                    'required'=> false,
                    'label'=>'Pays',
                    'class'=>'App\Entity\Pays',
                    'choice_label'=>'titre',
                    'attr'=>[
                        'class'=>'select2'
                    ]

                ))


            ->add('codepostale',TextType::class, array(
                'label' => 'Code Postale',
                'required' => false,

                'attr' => array('class'=>"default")
            ))



        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_user';
    }


}
