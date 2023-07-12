<?php

namespace App\Form;

use App\Entity\Console;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('picto')
            ->add('launchDate', DateType::class,[
                'input'=>'string',
                'widget'=>'single_text'
            ])
            ->add('price')
            ->add('entreprise')
            ->add('pays')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Console::class,
        ]);
    }
}