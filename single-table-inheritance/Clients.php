<?php

/**
 * @property int $id
 * @property string $type m:enum(self::TYPE_*)
 * @property string $name
 */
abstract class Client extends LeanMapper\Entity
{
	const TYPE_INDIVIDUAL = 'individual';
	const TYPE_COMPANY = 'company';
}


/**
 * @property string $birthdate
 */
class ClientIndividual extends Client
{
	protected function initDefaults(): void
	{
		$this->type = self::TYPE_INDIVIDUAL;
	}
}


/**
 * @property string $ic
 * @property string $dic
 */
class ClientCompany extends Client
{
	protected function initDefaults(): void
	{
		$this->type = self::TYPE_COMPANY;
	}
}


class ClientRepository extends BaseRepository
{
}
