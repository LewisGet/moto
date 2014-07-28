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
     * @return  Mixed
     */
    public static function find(ObjectRepository $repository, Request $request, $alias = "o",
                                array $option = array("filterName" => "filter", "like" => array("title"), "same" => array(), "between" => array()))
    {
        $like = array();
        $same = array();
        $between = array();

        $filter = $request->query->get($option['filterName'], array());

        $queryBuilder = $repository->createQueryBuilder($alias);

        foreach($option['like'] as $likeFilterName)
        {
            $value = isset($filter[$likeFilterName]) ? $filter[$likeFilterName] : null;

            if (empty($value))
            {
                continue;
            }

            $like[] = "{$alias}.{$likeFilterName} LIKE '%{$value}%'";
        }

        if (! empty($like))
        {
            $queryBuilder->where(implode(" OR ", $like));
        }

        foreach($option['same'] as $sameFilterName)
        {
            $value = isset($filter[$sameFilterName]) ? $filter[$sameFilterName] : null;

            if (empty($value))
            {
                continue;
            }

            $same[] = "{$alias}.{$sameFilterName} = '{$value}'";
        }

        if (! empty($same))
        {
            $queryBuilder->andWhere(implode(" AND ", $same));
        }

        foreach($option['between'] as $betweenFilterName)
        {
            $max = isset($filter[$betweenFilterName . "Max"]) ? $filter[$betweenFilterName . "Max"] : null;
            $min = isset($filter[$betweenFilterName . "Min"]) ? $filter[$betweenFilterName . "Min"] : null;

            if (! empty($max))
            {
                $between[] = "{$alias}.{$betweenFilterName} <= '{$max}'";
            }

            if (! empty($min))
            {
                $between[] = "{$alias}.{$betweenFilterName} >= '{$min}'";
            }
        }

        if (! empty($between))
        {
            $queryBuilder->andWhere(implode(" AND ", $between));
        }

        return $queryBuilder->getQuery();
    }
}