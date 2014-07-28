<?php

namespace Aedes\MotoBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MotoType extends AbstractType
{
    public $user;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('price')
            ->add('status')
            ->add('displacement')
            ->add('fuel')
            ->add('years')
            ->add('mileage')
            ->add('cooling')
            ->add('modifiedContent')
            ->add('tradingContent')
            ->add('brand')
            ->add('image', null, array(
                'query_builder' =>  function(EntityRepository $er)
                {
                    return $er->createQueryBuilder('o')
                        ->where('o.createBy = :user')
                        ->setParameter("user", $this->user);
                }
            ))
            ->add('country')
            ->add('city')
            ->add('area')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Aedes\MotoBundle\Entity\Moto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'aedes_motobundle_moto';
    }
}
