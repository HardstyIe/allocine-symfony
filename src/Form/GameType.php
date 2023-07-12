<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('isEnable')
            ->add('picture')
            ->add('launchDate')
            ->add('isOnline')
            ->add('isMultiplayer')
            ->add('minPlayerOffline')
            ->add('maxPlayerOffline')
            ->add('minPlayerOnline')
            ->add('maxPlayerOnline')
            ->add('consoles')
            ->add('entreprises')
            ->add('genres')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
