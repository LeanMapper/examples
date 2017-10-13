<?php

require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/Mapper.php';


$mapper = new Mapper;
$entityClass = 'Model\Entity\ClientCompany';
$table = 'client_company';
$column = 'company_name';
$property = 'companyName';
$repositoryClass = 'Model\ClientCompanyRepository';

superscribe('getTable()');
write($entityClass . ' => ' . $mapper->getTable($entityClass));
separate();

superscribe('getEntityClass()');
write($table . ' => ' . $mapper->getEntityClass($table));
separate();

superscribe('getColumn()');
write($property . ' => ' . $mapper->getColumn($entityClass, $property));
separate();

superscribe('getEntityField()');
write($column . ' => ' . $mapper->getEntityField($table, $column));
separate();

superscribe('getTableByRepositoryClass()');
write($repositoryClass . ' => ' . $mapper->getTableByRepositoryClass($repositoryClass));
separate();
