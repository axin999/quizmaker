<?php

use classes\Quiz;
include "includes/autoloader.inc.php";


echo $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$samplequiz = new Quiz();

$samplequiz->createQuiz();
