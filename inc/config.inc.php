<?php
require_once(dirname(__FILE__) . '/constants.inc.php');
require_once(DOC_ROOT . 'vendor/autoload.php');

# Set include paths
$includePath  = get_include_path() . PATH_SEPARATOR;

$includePath .= DOC_ROOT . PATH_SEPARATOR;
$includePath .= DOC_ROOT . 'Erfurt/' . PATH_SEPARATOR;
$includePath .= DOC_ROOT . 'Zend/'. PATH_SEPARATOR;

set_include_path($includePath);

require_once('Zend/Loader/Autoloader.php');

# Configure Zend Autoloader
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('Erfurt_');