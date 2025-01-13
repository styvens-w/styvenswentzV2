<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('start', null, [
                'widget' => 'single_text',
            ])
            ->add('end', null, [
                'widget' => 'single_text',
            ])
            ->add('site')
            ->add('github')
            ->add('description')
            ->add('activity', EntityType::class, [
                'class' => Activity::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
