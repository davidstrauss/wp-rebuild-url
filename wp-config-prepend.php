<?php

// Place the following at the beginning of wp-config.php

function rebuild_qs( $query_string ) {
	parse_str( $query_string, $parts );
	$qs = http_build_query( $parts, null, '&', PHP_QUERY_RFC3986 );

	// Remove equal signs for keys without values.
	$qs = rtrim($qs, '=');
	$qs = str_replace('=&', '&', $qs);

	return $qs;
}

if ( php_sapi_name() !== 'cli' ) {
	// WordPress appends this to $_SERVER['REQUEST_URI'], but we'll clean
	// it up anyway.
	if ( ! empty( $_SERVER['QUERY_STRING'] ) ) {
		$_SERVER['QUERY_STRING'] = rebuild_qs( $_SERVER['QUERY_STRING'] );
	}

	// Recover and rebuild the appended query string.
	$parts = explode( '?', $_SERVER['REQUEST_URI'], 2 );
	if ( 2 === count( $parts ) ) {
		$_SERVER['REQUEST_URI'] = $parts[0] . '?' . rebuild_qs( $parts[1] );
	}
}
