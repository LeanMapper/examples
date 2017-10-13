<?php

require __DIR__ . '/vendor/autoload.php';


function write($value, $indent = 0) {
	echo str_repeat(' ', $indent), $value, "\n";
}


function separate() {
	echo "\n-----\n\n";
}


function superscribe($heading) {
	echo $heading . "\n", str_repeat('=', mb_strlen($heading, 'utf8')) . "\n\n";
}


function createDatabase($dbFile, $dumpFile) {
	@unlink($dbFile);
	$connection = new LeanMapper\Connection(array(
		'driver' => 'sqlite3',
		'database' => $dbFile,
	));
	$connection->loadFile($dumpFile);
	return $connection;
}


abstract class BaseMapper extends \LeanMapper\DefaultMapper
{
	protected $defaultEntityNamespace = '';
}


abstract class BaseRepository extends \LeanMapper\Repository
{
	public function find($id)
	{
		$row = $this->connection->select('*')
			->from($this->getTable())
			->where('id = %i', $id)
			->fetch();

		if ($row === false) {
			throw new \Exception('Entity was not found.');
		}
		return $this->createEntity($row);
	}


	public function findAll()
	{
		return $this->createEntities(
			$this->connection->select('*')
				->from($this->getTable())
				->fetchAll()
		);
	}
}

