<?php

namespace ItechSup\ItechSisBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DayOfWeekType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            //ISO-860
            'choices' => array(
                '1' => 'Lundi',
                '2' => 'Mardi',
                '3' => 'Mercredi',
                '4' => 'Jeudi',
                '5' => 'Vendredi',
            )
        ));
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'day_of_week';
    }
}