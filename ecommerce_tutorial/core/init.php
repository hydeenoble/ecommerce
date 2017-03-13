<?php
/**
 * Created by PhpStorm.
 * User: hydee
 * Date: 3/6/17
 * Time: 12:17 PM
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = mysqli_connect('127.0.0.1','root','root','tutorial');
if (mysqli_connect_errno()){
    echo 'Database Connection failed with following errors: ' . mysqli_connect_error();
    die();
}
require_once $_SERVER['DOCUMENT_ROOT'].'/codebag/ecommerce_tutorial/config.php';
require_once BASEURL.'helpers/helpers.php';
