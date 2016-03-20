<?php
require_once(dirname(__FILE__) . '/../inc/config.inc.php');

# Creating an instance of Erfurt API
$app = Erfurt_App::getInstance();

# Authentification on Erfurt (needed for model access)
$dbUser = $app->getStore()->getDbUser();
$dbPass = $app->getStore()->getDbPassword();
$app->authenticate($dbUser, $dbPass);

try {
    $app->getStore()->deleteModel('http://aksw.org/PhilippFrischmuth.rdf');
} catch (Exception $ex) { }
try {
    $app->getStore()->deleteModel('http://aksw.org/ThomasRiechert.rdf');
} catch (Exception $ex) { }