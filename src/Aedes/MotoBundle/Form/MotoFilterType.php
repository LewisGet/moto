<?php

namespace Aedes\MotoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MotoFilterType extends AbstractType
{
    public $config;

    function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        foreach (isset($this->config['same']) ? $this->config['same'] : array() as $filterName)
        {
            $builder->add($filterName, null, array('required' => false));
        }

        foreach (isset($this->config['like']) ? $this->config['like'] : array() as $filterName)
        {
            $builder->add($filterName, null, array('required' => false));
        }

        foreach (isset($this->config['between']) ? $this->config['between'] : array() as $filterName)
        {
            $builder->add($filterName . "Max", null, array('required' => false));
            $builder->add($filterName . "Min", null, array('required' => false));
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->config['filterName'];
    }
}