<?php

namespace App\Form;

use App\Entity\Conger;
use App\Form\DataTransformer\FrenchToDateTimeTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeCongerType extends AbstractType
{

    private $transformer;

    public function __construct( )
    {
        $this->transformer = new  FrenchToDateTimeTransformer;

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('debutConger',TextType::class,array(
                'required'=>false,
                'attr'=>
                    [
                        ' autocomplete'=>"off"
                    ]
            ))

            ->add('finConger',TextType::class,array(
                'required'=>false,
                'attr'=>
                    [
                        ' autocomplete'=>"off"
                    ]
            ))
            ->add('nbjours',IntegerType::class,[
                'label'=>' Durée',
                'attr'=>[
                    'min'=>0,
                    ' autocomplete'=>"off"

                ]])
            ->add('typeConger',EntityType::class,[
                 'multiple'=>false,
                'label'=>'choisissez Type De conger',
                'class'=>'App\Entity\TypeConger',
                'choice_label'=>'titre'


                ])

            ->add('cause')
            ->add('fichier', FileType::class, array(
                'required' => false,
                'mapped'=>false,
                'label' => false,))        ;

        $builder->get('debutConger')->addModelTransformer($this->transformer);
        $builder->get('finConger')->addModelTransformer($this->transformer);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Conger::class,
        ]);
    }
}
