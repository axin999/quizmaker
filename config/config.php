<?php 
define('DEBUG', true);
define('DB_NAME','quiz_maker');
define('DB_USER','engelbert');
define('DB_PASSWORD','131313');
define('DB_HOST','127.0.0.1');
define('DEFAULT_CONTROLLER', 'Home');// default controller if there isnt one in the url
define('DEFAULT_LAYOUT', 'default');//
define('PROJECT_ROOT', '/Quizmaker/');
define('SITE_TITLE', 'Quizmaker');
define('MENU_BRAND', 'AXIN');

define('CURRENT_USER_SESSION_NAME', 'jakalawussy'); //just random characters for session name for logged in user
define('REMEMBER_ME_COOKIE_NAME', 'jakalawwetsai'); //just random characters cookie name for loged in user
define('REMEMBER_ME_COOKIE_EXPIRY', 2592000);// time in seconds for remeber me cookie to libe (30 days)

define('ACCESS_RESTRICTED', 'Restricted'); //controller name for the restricted redirect.