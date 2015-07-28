<?php
/**
 * Created by PhpStorm.
 * User: katchou
 * Date: 28/07/2015
 * Time: 09:59
 */

namespace ItechSup\ItechSisBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PeriodicTimeSlotType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dayOfWeek', new DayOfWeekType(), ['label' => 'Jour'])
            ->add('startTime', 'time', ['label' => 'Heure de début'])
            ->add('endTime', 'time', ['label' => 'Heure de fin']);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ItechSup\ItechSisBundle\Entity\PeriodicTimeSlot'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'itechsup_itechsisbundle_periodictimeslot';
    }
}

    {

    }