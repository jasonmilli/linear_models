<?php

function p($input, $comment = '')
{
    echo "{$comment}<pre>" . print_r($input, true) . "</pre>";
}

function chNum($array, $key)
{
    return isset($array[$key]) && is_numeric($array[$key]);
}

function chNums($array, $keys)
{
    foreach ($keys as $key) {
        if (!chNum($array, $key)) {
            return false;
        }
    }
    return true;
}
