<?php
/**
 * Created by PhpStorm.
 * User: zhoupan
 * Date: 6/15/16
 * Time: 10:07 AM
 */
session_start();
if(isset($_SESSION["username"])){
    echo "user:".$_SESSION["username"]."<br/>";
}
if(isset($_SESSION["identity"])){
    echo "identity:".$_SESSION["identity"];
}