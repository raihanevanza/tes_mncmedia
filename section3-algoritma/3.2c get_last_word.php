<?php

function getLastWord($word, $separator)
{
    $list_word = explode($separator, $word);
    $total_word = count($list_word);
    $last_word = $list_word[$total_word - 1];

    return $last_word;
}

$word = ':https://bola.okezone.com/read/2022/08/05/47/2642706/juventus-butu
h-paul-pogba-ini-harapan-massimiliano-allegri';

$separator = '/';
echo getLastWord($word, $separator);
