<?php
require_once(dirname(__FILE__) . '/../inc/config.inc.php');

$app = Erfurt_App::getInstance();

$dbUser = $app->getStore()->getDbUser();
$dbPass = $app->getStore()->getDbPassword();
$app->authenticate($dbUser, $dbPass);

header("Content-Type: text/plain");

$modelUri = 'http://aksw.org/ThomasRiechert.rdf';
try {
    $model = $app->getStore()->getNewModel($modelUri);
    $ret = $app->getStore()->importRdf($model, $modelUri, 'xml', Erfurt_Syntax_RdfParser::LOCATOR_URL);
} catch (Erfurt_Store_Exception $e) {
    echo "Model '" . $modelUri . "' already exists!\n";
}
$modelUri = 'http://aksw.org/PhilippFrischmuth.rdf';
try {
    $model = $app->getStore()->getNewModel($modelUri);
    $ret = $app->getStore()->importRdf($model, $modelUri, 'xml', Erfurt_Syntax_RdfParser::LOCATOR_URL);
} catch (Erfurt_Store_Exception $e) {
    echo "Model '" . $modelUri . "' already exists!\n";
}
