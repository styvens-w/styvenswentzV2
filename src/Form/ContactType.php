<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        unset($options);

        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Nom',
                'attr' => ['placeholder' => 'Votre nom']
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['placeholder' => 'Votre prénom']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['placeholder' => 'Votre email']
            ])
            ->add('subject', TextType::class, [
                'label' => 'Sujet',
                'attr' => ['placeholder' => 'Votre sujet']
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'row_attr' => ['class' => 'message'],
                'attr' => ['placeholder' => 'Votre message']
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => ['class' => 'btn btn-primary']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
