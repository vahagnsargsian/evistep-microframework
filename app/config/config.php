<?php

//SERVER CONFIGURATION
ini_set('display_errors',1);
ini_set('log_errors',1);
ini_set('error_log', ROOT.'/logs/error_logs.txt');
error_reporting(E_ALL);    

//data extension
define('MYSQL_HOST','localhost');
define('DB_NAME','microframework');
define('DB_USER_NAME','root');
define('DB_PASS','');

//debuglogger extension
define('LOG_FILE_PATH', ROOT.'/logs/application_logs.txt');