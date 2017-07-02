<?php

// //验证码校验
// function check_verify($code, $id='')
// {
//     $verify = new \Think\Verify();
//     return $verify->check($code, $id);
// }

function p($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/* 正则表达 */
function pregUsername($str)
{
    $pattern = "/^[a-zA-Z][a-zA-Z0-9_]{5,17}$/";
    if (preg_match($pattern, $str, $matches)) {
        return true;
    } else {
        return false;
    }
}

function pregPhoneNumber($str)
{
    $pattern = "/^1\d{10}$/";
    if (preg_match($pattern, $str, $res)) {
        return true;
    } else {
        return false;
    }
}

function pregStuID($str)
{
    $pattern = "/\d{11}|\d{12}/";
    if (preg_match($pattern, $str, $res)) {
        return true;
    } else {
        return false;
    }
}

function pregPassword($str)
{
    if (preg_match("/^[\\~!@#$%^&*()-_=+|{}\[\],.?\/:;\'\"\d\w]{6,20}$/", $str, $res)) {
        return true;
    } else {
        return false;
    }
}
