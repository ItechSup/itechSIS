<?php

namespace ItechSup\ItechSisBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClosingDayType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reason', null, ['label' => 'Motif'])
            ->add('closingDate', null, ['label' => 'Date'])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ItechSup\ItechSisBundle\Entity\ClosingDay'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'itechsup_itechsisbundle_closingday';
    }
}
