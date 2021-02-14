<?php

class Mapper extends BaseMapper
{
	public function getEntityClass(string $table, LeanMapper\Row $row = null): string
	{
		if ($table === 'client') {
			if (isset($row->type)) {
				return $row->type === Client::TYPE_INDIVIDUAL ? ClientIndividual::class : ClientCompany::class;
			}

			return Client::class;
		}

		return parent::getEntityClass($table, $row);
	}


	public function getTable(string $entity): string
	{
		if ($entity === ClientIndividual::class || $entity === ClientCompany::class) {
			return 'client';
		}
		return parent::getTable($entity);
	}
}
