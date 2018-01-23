<?php

Class Gender{

    /**
     * gender male/female check
     * genderM for setting value male
     * genderF for setting value female
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

}