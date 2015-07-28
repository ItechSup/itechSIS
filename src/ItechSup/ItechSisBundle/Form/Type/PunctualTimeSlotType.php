<?php

namespace ItechSup\ItechSisBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PunctualTimeSlotType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('day', 'date', ['label' => 'Jour'])
            ->add('startTime', 'time', ['label' => 'Heure de début'])
            ->add('endTime', 'time', ['label' => 'Heure de fin']);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ItechSup\ItechSisBundle\Entity\PunctualTimeSlot'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'itechsup_itechsisbundle_punctualtimeslot';
    }
}
