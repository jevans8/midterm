<?php

//Julia Evans
//Midterm
//5-20-2020

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require the autoload file
require_once('vendor/autoload.php');
//require_once('model/data.php');

//Instantiate the framework (Base class)
$f3 = Base::instance();

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Default route
$f3->route('GET /', function()
{

    //echo "<h2>Midterm Survey</h2>";
    //echo "<a href='survey'>Take my Midterm Survey</a>";

    $view = new Template();
    echo $view->render('views/home.html');

});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Survey route
$f3->route('GET|POST /survey', function($f3)
{

    //if form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        //required fields
        if(empty($_POST['name']))
        {
            $f3->set('errors["name"]', "Required field");
        }
        if(empty($_POST['survey']))
        {
            $f3->set('errors["survey"]', "Please select at least one option");
        }

        //valid data
        if(empty($f3->get('errors')))
        {
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['survey'] = $_POST['survey'];

            //redirect
            $f3->reroute('summary');

        }

    }

    $view = new Template();
    echo $view->render('views/survey.html');

});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Summary route
$f3->route('GET|POST /summary', function(){

    $view = new Template();
    echo $view->render('views/summary.html');

});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Run the framework (fat free)
$f3->run();