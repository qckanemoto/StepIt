<?php

namespace Steppie\Bundle\AppBundle\Form\Type;

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
                'class' => 'Steppie\Bundle\AppBundle\Entity\Matter',
            ])
            ->add('step', 'entity', [
                'class' => 'Steppie\Bundle\AppBundle\Entity\Step',
            ])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => 'Steppie\Bundle\AppBundle\Entity\Content',
            ])
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'steppie_app_content';
    }
}
