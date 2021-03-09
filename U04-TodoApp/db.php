<?php

//defining constants in config file to be able to connect to mySQL database
//credentials from database with default settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'dbTodo');

//create connection
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//check connection
if(!$connection) {
    die("Error - Cannot connect to database " . mysqli_error($connection));
}