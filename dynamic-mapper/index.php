<?php

require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/DynamicMapper.php';


$mapper = new DynamicMapper;
$mapper = new DynamicMapper;
$mapper->registerModule('news', array('item', 'comment', 'rating'));
$mapper->registerModule('content', array('page', 'text'));

write('Addon\News\Entity\Comment => ' . $mapper->getTable('Addon\News\Entity\Comment'));

write('news_comment => ' . $mapper->getEntityClass('news_comment'));
