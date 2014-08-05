<?php

namespace Aedes\MotoBundle\Helper;

use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Component\HttpFoundation\Request;

class Filter
{
    /**
     * find
     *
     * @param \Doctrine\Common\Persistence\ObjectRepository $repository
     * @param Request                                       $request
     * @param string                                        $alias
     * @param array                                         $option
     *
     * $option 詳細設定如下
     *
     * like    => like 內所有值皆為字串，他將使用 request 同名參數去 dql 同名欄位塞選 Like 條件
     * same    => same 內所有值皆為字串，他將使用 request 同名參數去 dql 同名欄位塞選 相同 條件
     * between => between 內所有值皆為字串，他將使用 request 值加上 Max 與 Min 參數去 dql 塞選之間值
     *            如對應名稱無值時不設定參數
     *
     *
     * @return  Mixed
     */
    public static function find(ObjectRepository $repository, Request $request, $alias = "o",
                                array $option = array("filterName" => "filter", "like" => array("title"), "same" => array(), "between" => array()))
    {
        $filter = $request->query->get($option['filterName'], array());
        $where = array();

        foreach(array("same", "like", "between") as $type)
        {
            if (isset($option[$type]))
            {
                $tmp = static::$type($alias, $option[$type], $filter);

                $where = array_merge($where, $tmp);
            }
        }

        $queryBuilder = $repository->createQueryBuilder($alias);

        if (! empty($where))
        {
            $queryBuilder->andWhere(implode(" AND ", $where));
        }

        return $queryBuilder;
    }

    public static function same($queryAlias, $sameOption, $filter)
    {
        $same = array();

        foreach($sameOption as $sameFilterName)
        {
            $value = isset($filter[$sameFilterName]) ? $filter[$sameFilterName] : null;

            if (empty($value))
            {
                continue;
            }

            $same[] = "{$queryAlias}.{$sameFilterName} = '{$value}'";
        }

        return $same;
    }

    public static function like($queryAlias, $likeOption, $filter)
    {
        $like = array();

        foreach($likeOption as $likeFilterName)
        {
            $value = isset($filter[$likeFilterName]) ? $filter[$likeFilterName] : null;

            if (empty($value))
            {
                continue;
            }

            $like[] = "{$queryAlias}.{$likeFilterName} LIKE '%{$value}%'";
        }

        return $like;
    }

    public static function between($queryAlias, $betweenOption, $filter)
    {
        $between = array();

        foreach($betweenOption as $betweenFilterName)
        {
            $max = isset($filter[$betweenFilterName . "Max"]) ? $filter[$betweenFilterName . "Max"] : null;
            $min = isset($filter[$betweenFilterName . "Min"]) ? $filter[$betweenFilterName . "Min"] : null;

            if (! empty($max))
            {
                $between[] = "{$queryAlias}.{$betweenFilterName} <= '{$max}'";
            }

            if (! empty($min))
            {
                $between[] = "{$queryAlias}.{$betweenFilterName} >= '{$min}'";
            }
        }

        return $between;
    }
}