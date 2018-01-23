<?php
/**
 * gender male/female check
 */

function genderM($var)
{
    $ret = '';
    if ($var == 'male') {
        $ret = 'checked';
    }
    return $ret;
}

function genderF($var)
{
    $ret = '';
    if ($var == 'female') {
        $ret = 'checked';
    }
    return $ret;
}





