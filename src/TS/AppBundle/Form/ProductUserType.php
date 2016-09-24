<?php

namespace TS\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductUserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status')
            ->add('mark')
            ->add('likes')
            ->add('comment')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('user')
            ->add('product')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'TS\AppBundle\Entity\ProductUser'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ts_appbundle_productuser';
    }
}
