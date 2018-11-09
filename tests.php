<?php

require 'wp-config-prepend.php';

$cases = [
	'kw=123:456&pub_cr_id=789' => 'kw=123%3A456&pub_cr_id=789',
	'kw=123%3a456&pub_cr_id=789' => 'kw=123%3A456&pub_cr_id=789'
];

foreach ($cases as $input => $expected) {
	echo 'Case: ' . $input . ' => ' . $expected . ': ';
	$actual = rebuild_qs($input);
	if ( $actual === $expected ) {
		echo 'Pass';
	} else {
		echo 'Fail';
	}
	echo PHP_EOL;
}
