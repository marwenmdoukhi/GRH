<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder            ->remove('username')

        ->add('name')
        ->add('lastname')
        ->add('telephone')
            ->add('roles', ChoiceType::class, array(
                'attr'=>[
                    'class'=>'select2'
                ],
                'multiple' => true,
                'expanded' => false, // render check-boxes
                'choices' => [
                    '' => NULL,
                    'employer' => 'ROLE_EMPLOYE',
                    'ressource humaine' => 'ROLE_ROS',
                ]
            ))



    ;
    }

    public function getParent() {
        return BaseRegistrationFormType::class;
    }


    public function getBlockPrefix() {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName() {
        return $this->getBlockPrefix();
    }

}
