<?php

use Nextras\Migrations\Bridges;
use Nextras\Migrations\Controllers;
use Nextras\Migrations\Drivers;
use Nextras\Migrations\Extensions;

require __DIR__ . '/../../vendor/autoload.php';

$conn = new LeanMapper\Connection(array(
	'driver' => 'mysqli',
	'host' => 'localhost',
	'username' => 'root',
	'password' => '***',
	'database' => 'mydatabase',
));
$dbal = new Bridges\Dibi\Dibi3Adapter($conn);
$driver = new Drivers\MySqlDriver($dbal);

$controller = php_sapi_name() === 'cli'
	? new Controllers\ConsoleController($driver)
	: new Controllers\HttpController($driver);

$baseDir = __DIR__;
$controller->addGroup('structures', "$baseDir/structures");
$controller->addGroup('basic-data', "$baseDir/basic-data", array('structures'));
$controller->addGroup('dummy-data', "$baseDir/dummy-data", array('basic-data'));
$controller->addExtension('sql', new Extensions\SqlHandler($driver));

$controller->run();
