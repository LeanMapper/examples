<?php

require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/Mapper.php';
require __DIR__ . '/Clients.php';


$clientRepository = new ClientRepository(
	createDatabase(__DIR__ . '/db/clients.sq3', __DIR__ . '/db/dump-sqlite.sql'),
	new Mapper,
	new LeanMapper\DefaultEntityFactory
);

// persistence
$individual = new ClientIndividual;
$individual->name = 'John Doe';
$individual->birthdate = '1970-01-01';

$clientRepository->persist($individual);


$company = new ClientCompany;
$company->name = 'Seznam.cz';
$company->ic = '26168685';
$company->dic = 'CZ26168685';

$clientRepository->persist($company);


// loads
$entity = $clientRepository->find(1);
write(get_class($entity));
var_dump($entity->getData());

$entity = $clientRepository->find(2);
write(get_class($entity));
var_dump($entity->getData());
