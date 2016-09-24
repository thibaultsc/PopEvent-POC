<?php

namespace TS\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('title',      'text')
            ->add('description',     'text')
            //->add('brand', 'textarea')
            ->add('image',      new ImageType()) 
            ->add('size', 'entity', array(
                'class' => 'TSAppBundle:SizeProduct',
                'property' => 'name',
                ))
            ->add('category', 'entity', array(
                'class' => 'TSAppBundle:Category',
                'property' => 'name'
                ))
            ->add('quality', 'entity', array(
                'class' => 'TSAppBundle:Quality',
                'property' => 'name',
                ))
            ->add('brand', 'entity', array(
                'class' => 'TSAppBundle:Brand',
                'property' => 'name',
                ))
            ->add('color', 'entity', array(
                'class' => 'TSAppBundle:Color',
                'property' => 'name',
                ))
            ->add('price',     'number')
            ->add('photoFile', null, ['required' => false])
            
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TS\AppBundle\Entity\Product'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ts_appbundle_product';
    }
}
