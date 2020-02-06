<?php
session_start();

require_once 'class_onesource.php';

$obj = new OneSource();
$obj->doAction();
