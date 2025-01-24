<?php

namespace App\Form;

use App\Entity\Activity;
use App\Entity\Project;
use App\Entity\Techno;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('start', null, [
                'widget' => 'single_text',
                'label' => 'Date de début'
            ])
            ->add('end', null, [
                'widget' => 'single_text',
                'label' => 'Date de fin'
            ])
            ->add('site', TextType::class, ['required' => false])
            ->add('github', TextType::class, ['required' => false])
            ->add('description', TextareaType::class, ['required' => false])
            ->add('activity', EntityType::class, [
                'class' => Activity::class,
                'choice_label' => 'name',
                'label' => 'Pour l\'activité',
            ])
            ->add('close', ChoiceType::class, [
                'label' => 'Le site est t\'il fermer ?',
                'choices'  => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('technos', EntityType::class, [
                'class' => Techno::class,
                'choice_label' => 'name',
                'label' => 'Technologies',
                'multiple' => true,
                'expanded' => true,
                'required' => false,
                'by_reference' => false,
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
