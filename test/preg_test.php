<?php
/**
 * Created by PhpStorm.
 * User: zhoupan
 * Date: 6/16/16
 * Time: 12:40 PM
 */
$str='111111111111111';
$isMatched = preg_match('/[1-9]\d{14}/', $str, $matches);
//var_dump($isMatched, $matches);
echo $isMatched;