<?php
/**
 * Created by PhpStorm.
 * User: hydee
 * Date: 3/8/17
 * Time: 3:21 PM
 */

function display_errors($errors){
    $display = '<ul class="bg-danger">';
    foreach ($errors as $error){
        $display .= '<li class="text-warning">'.$error.'</li>';
    }
    $display .= '</ul>';
    return $display;
}


function sanitize($dirty){
    return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}