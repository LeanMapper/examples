<?php

class DynamicMapper extends \LeanMapper\DefaultMapper
{
	private $dictionary = array();


	public function registerModule($modulePrefix, array $names)
	{
		foreach ($names as $name) {
			$this->dictionary[$modulePrefix . '_' . $name] =
				'Addon\\' . ucfirst($modulePrefix) . '\\Entity\\' . ucfirst($name);
		}
	}


	public function getTable($entityClass)
	{
		foreach ($this->dictionary as $table => $entity) {
			if ($entityClass === $entity) {
				return $table;
			}
		}
		return parent::getTable($entityClass);
	}


	public function getEntityClass($table, LeanMapper\Row $row = null)
	{
		if (isset($this->dictionary[$table])) {
			return $this->dictionary[$table];
		}
		return parent::getEntityClass($table, $row);
	}
}
