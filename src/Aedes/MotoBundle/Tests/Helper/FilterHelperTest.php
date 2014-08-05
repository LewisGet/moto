<?php

namespace Aedes\MotoBundle\Tests\Controller;

use Aedes\MotoBundle\Helper\Filter;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FilterHelperTest extends WebTestCase
{
    public function testSame()
    {
        $same = array(
            'id',
            'status'
        );

        $request = array(
            'id' => 1,
            'status' => 2
        );

        $return = array(
            'o.id = \'1\'',
            'o.status = \'2\''
        );

        $sameFilter = Filter::same("o", $same, $request);

        $this->assertSame($sameFilter, $return);
    }
}
