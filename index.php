<?php

//Julia Evans
//Midterm
//5-20-2020

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Start session (AFTER requiring autoload)
session_start();

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

    $surveyOptions = array("This midterm is easy", "I like midterms", "Today is Monday");

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
            $_SESSION['surveySelections'] = $_POST['survey'];

            //redirect
            $f3->reroute('summary');
        }

    }

    //store variables in f3 hive (to make form sticky)
    $f3->set('name', $_POST['name']);
    $f3->set('surveyOptions', $surveyOptions);
    $f3->set('surveySelections', $_POST['survey']);

    $view = new Template();
    echo $view->render('views/survey.html');

});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Summary route
$f3->route('GET|POST /summary', function()
{

    $view = new Template();
    echo $view->render('views/summary.html');

    //end session
    session_destroy();

});

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Run the framework (fat free)
$f3->run();