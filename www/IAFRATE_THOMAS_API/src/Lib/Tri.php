<?php

namespace src\Lib;
class Tri
{

    static function TriInsertion($list)
    {
        for ($i = 1; $i < count($list); $i++) {
            $valueInsert = $list[$i];
            $j = $i - 1;
            while ($j >= 0 && $list[$j] > $valueInsert) {
                $list[$j + 1] = $list[$j];
                $j--;
            }
            $list[$j + 1] = $valueInsert;
        }
        return $list;
    }

    static function QuickSort($tab)
    { // ce tri est récursif
        $size = count($tab);
        if ($size <= 1) {
            return $tab;
        }

        $tmp = $tab[0];
        $left = array();
        $right = array();
        for ($i = 1; $i < $size; $i++) {
            if ($tab[$i] < $tmp) {
                $left[] = $tab[$i];
            } else {
                $right[] = $tab[$i];
            }
        }
        return array_merge(self::QuickSort($left), array($tmp), self::QuickSort($right));
    }

}
