<?php

class Mapper extends \LeanMapper\DefaultMapper
{
	public function getTable($entityClass)
	{
		return self::toUnderScore($this->trimNamespace($entityClass));
	}


	public function getEntityClass($table, LeanMapper\Row $row = NULL)
	{
		return ($this->defaultEntityNamespace !== NULL ? $this->defaultEntityNamespace . '\\' : '')
			. ucfirst(self::toCamelCase($table)); // Název třídy začíná velkým písmenem
	}


	public function getColumn($entityClass, $field)
	{
		return self::toUnderScore($field);
	}


	public function getEntityField($table, $column)
	{
		return self::toCamelCase($column);
	}


	public function getTableByRepositoryClass($repositoryClass)
	{
		$matches = array();
		if (preg_match('#([a-z0-9]+)repository$#i', $repositoryClass, $matches)) {
			return self::toUnderScore($matches[1]);
		}
		throw new LeanMapper\Exception\InvalidStateException('Cannot determine table name.');
	}


	public static function toUnderScore($str)
	{
		return lcfirst(preg_replace_callback('#(?<=.)([A-Z])#', function ($m) {
			return '_' . strtolower($m[1]);
		}, $str));
	}


	public static function toCamelCase($str)
	{
		return preg_replace_callback('#_(.)#', function ($m) {
			return strtoupper($m[1]);
		}, $str);
	}
}
