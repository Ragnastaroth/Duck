<?php
session_start(); 
$bdd = new PDO('mysql:host=localhost;dbname=ducks;charset=utf8', 'root', '');
// var_dump($_SESSION);