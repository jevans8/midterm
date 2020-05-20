<?php

//Julia Evans
//Midterm
//5-20-2020

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
//session_start();

//Require the autoload file
require_once('vendor/autoload.php');
//require_once('model/data.php');

//Instantiate the framework (Base class)
$f3 = Base::instance();

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Default route
$f3->route('GET /', function(){

    //echo "<h2>Midterm Survey</h2>";
    //echo "<a href='survey'>Take my Midterm Survey</a>";

    $view = new Template();
    echo $view->render('views/home.html');

});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Survey route
$f3->route('GET|POST /survey', function(){

    $view = new Template();
    echo $view->render('views/survey.html');

});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Run the framework (fat free)
$f3->run();