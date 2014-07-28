<?php

namespace Aedes\UserBundle\Form\Type;

use FOS\UserBundle\Form\Type\ProfileFormType as FosProfileFormType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileFormType extends FosProfileFormType
{
    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle', 'read_only' => true))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'read_only' => true))
            ->add('phone', null, array('label' => 'form.phone', 'translation_domain' => 'FOSUserBundle'))
            ->add('mobile', null, array('label' => 'form.mobile', 'translation_domain' => 'FOSUserBundle'))
            ->add('contact', null, array('label' => 'form.contact', 'translation_domain' => 'FOSUserBundle'))
            ->add('ezTime', null, array('label' => 'form.ez_time', 'translation_domain' => 'FOSUserBundle'))
        ;
    }

    public function getName()
    {
        return 'aedes_user_profile';
    }

}
