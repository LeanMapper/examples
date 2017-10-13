
# Single Table Inheritance

**Single Table Inheritance** je způsob, jak emulovat objektovou dědičnost v relační databázi.

V principu to funguje tak, že databázová tabulka obsahuje jeden čí více sloupců, který určuje, na jaký objekt (entitu) se má řádek tabulky mapovat. Při persistenci jsou pak data všech příbuzných objektů uložena do stejné tabulky.

Uveďme si příklad. V aplikaci máme 2 typy klientů - jedním jsou fyzické osoby a druhým právnické osoby. Protože oba typy sdílí některé společné údaje, budou oba uloženy v tabulce `client`. Entity můžou vypadat takto (viz soubor `Clients.php`):

``` php
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
	protected function initDefaults()
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
	protected function initDefaults()
	{
		$this->type = self::TYPE_COMPANY;
	}
}
```


Všimněte si, že obě entity `ClientIndividual` i `ClientCompany` dědí od entity `Client`, obě budou taky pracovat nad stejnou tabulkou `client`:

```
|--------------------------------------------------------------------|
| id | type       | name       | birthdate   | ic       | dic        |
|--------------------------------------------------------------------|
| 1  | individual | John Doe   | 1970-01-01  | NULL     | NULL       |
| 2  | company    | Seznam.cz  | NULL        | 26168685 | CZ26168685 |
|--------------------------------------------------------------------|
```

Aby Lean Mapper věděl, jestli při načítání dat z tabulky `client` vytvořit entitu `ClientIndividual`, nebo `ClientCompany`, musíme mu to sdělit pomocí mapperu (soubor `Mapper.php`):

``` php
class Mapper extends \LeanMapper\DefaultMapper
{
	public function getEntityClass($table, LeanMapper\Row $row = NULL)
	{
		if ($table === 'client') {
			if (isset($row->type)) {
				return $row->type === Client::TYPE_INDIVIDUAL ? 'ClientIndividual' : 'ClientCompany';
			}

			return 'Client';
		}

		return parent::getEntityClass($table, $row);
	}


	public function getTable($entity)
	{
		if ($entity === 'ClientIndividual' || $entity === 'ClientCompany') {
			return 'client';
		}
		return parent::getTable();
	}
}
```

A to je vše. Při načtení řádku z databáze získáme vždy správný typ entity, stejně tak pokud budeme entitu persistovat, uloží se oba typy do správné tabulky `client`.
