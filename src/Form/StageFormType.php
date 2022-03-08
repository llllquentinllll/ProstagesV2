<?php

namespace App\Form;

use App\Entity\Stage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use App\Entity\Formation;
use App\Form\EntrepriseFormType;

class StageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextareaType::class)
            ->add('mission', TextareaType::class)
            ->add('email', EmailType::class)
            ->add('formations', EntityType::class, array(
                'class'=>Formation::class ,
                'choice_label'=>'nomLong',
                'multiple'=>true,
                'expanded'=>true
            ))
            ->add('entreprise', EntrepriseFormType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}



