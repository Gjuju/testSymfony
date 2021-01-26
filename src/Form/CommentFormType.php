<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            /* ->add('createdAt', DateTimeType::class, [
                'label' => 'Date'
            ]) */
            ->add('note', IntegerType::class, [
                'label' => 'Note',
                'required' => false
            ])
            ->add('text', TextareaType::class, [
                'label' => 'Commentaire'
            ])
            /* ->add('photoFileName') */
            /* ->add('conference') */
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [ 'class' => 'btn-primary' ]
            ]);
    }





    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
