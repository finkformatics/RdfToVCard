<?php

require_once(dirname(__FILE__) . '/../inc/config.inc.php');

$app = Erfurt_App::getInstance();

$dbUser = $app->getStore()->getDbUser();
$dbPass = $app->getStore()->getDbPassword();
$app->authenticate($dbUser, $dbPass);

header("Content-Type: text/plain");
$query = 'PREFIX foaf: <http://xmlns.com/foaf/0.1/> '
        . 'SELECT ?name '
        . 'WHERE { '
        . '?person a foaf:Person . '
        . '?person foaf:name ?name . '
        . '}';
$res = $app->getStore()->sparqlQuery($query);
foreach ($res as $person) {
    echo $person['name'] . "\n";
}