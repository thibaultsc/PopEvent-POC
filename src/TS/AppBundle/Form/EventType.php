<?php

namespace TS\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('dateevent',      'date')
        ->add('name',     'text')
        ->add('image',      new ImageType())  
        ->add('datebegin',      'date')
        ->add('dateend',      'date')
        ->add('datehoraire',   'number')
        ->add('description',    'text')
        ->add('priceplace',    'number')
        ->add('pricesalesman',    'number')
        ->add('address',    'text')
        ->add('enabled',    'checkbox')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TS\AppBundle\Entity\Event'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ts_appbundle_event';
    }
}
