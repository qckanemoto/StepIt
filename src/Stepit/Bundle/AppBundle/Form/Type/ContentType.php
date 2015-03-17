<?php

namespace Stepit\Bundle\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('value')
            ->add('matter', 'entity', [
                'class' => 'Stepit\Bundle\AppBundle\Entity\Matter',
            ])
            ->add('step', 'entity', [
                'class' => 'Stepit\Bundle\AppBundle\Entity\Step',
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => 'Stepit\Bundle\AppBundle\Entity\Content',
            ])
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'stepit_app_content';
    }
}
