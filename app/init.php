<?php

define('ROOT', dirname(__DIR__) . '/app');
define('PUBLIC_ROOT', dirname(__DIR__) . '/public');

require_once (ROOT.'/config/config.php');
require_once (ROOT.'/core/Router.php');
require_once (ROOT.'/core/BaseController.php');
require_once (ROOT.'/core/Autoloader.php');