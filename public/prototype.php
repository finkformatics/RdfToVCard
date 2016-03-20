<?php
require_once(dirname(__FILE__) . '/../inc/config.inc.php');

date_default_timezone_set('Europe/Berlin');

// Create a 'Prototype' instance
$prototype = Prototype\Prototype::getInstance();

header("Content-Type: text/plain");
// Start converting
$prototype->convert();