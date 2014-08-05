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

    public function testBetween()
    {
        $between = array(
            'years',
            'price'
        );

        $request = array(
            'yearsMin' => 1,
            'yearsMax' => 2,
            'priceMax' => 50
        );

        // TODO: 這裡有測試 bug ，因為條件其實先後順序是無差的，但 assertSame 會完全相等，需改成 is in array 然後用 assertTrue 來測試
        $return = array(
            'o.years <= \'2\'',
            'o.years >= \'1\'',
            'o.price <= \'50\'',
        );

        $betweenFilter = Filter::between("o", $between, $request);

        $this->assertSame($betweenFilter, $return);
    }

    public function testLike()
    {
        $like = array(
            'title',
            'content'
        );

        $request = array(
            'title' => 'some title',
            'content' => 'some content'
        );

        $return = array(
            'o.title LIKE \'%some title%\'',
            'o.content LIKE \'%some content%\''
        );

        $likeFilter = Filter::like("o", $like, $request);

        $this->assertSame($likeFilter, $return);
    }
}
