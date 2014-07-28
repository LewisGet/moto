<?php

namespace Aedes\MotoBundle\Filter;

class MotoFilter
{
    public static function listFilter()
    {
        return array(
            'filterName' => 'moto_filter',

            'like' => array(
                'title'
            ),
            'same' => array(
                'id'
            ),
            'between' => array(
                'years'
            )
        );
    }
}