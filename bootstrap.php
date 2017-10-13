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
