<?php
/**
 * Created by PhpStorm.
 * User: zhoupan
 * Date: 6/17/16
 * Time: 5:01 PM
 */
session_start();
if (!isset($_SESSION["username"]) || !isset($_SESSION["identity"])) {
    die("<h1>非法访问</h1>");
}