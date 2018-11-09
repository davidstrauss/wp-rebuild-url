<?php

// Place the following at the beginning of wp-config.php

function rebuild_qs( $query_string ) {
	parse_str( $query_string, $parts );
	return http_build_query( $parts, null, '&', PHP_QUERY_RFC3986 );
}

if ( php_sapi_name() !== 'cli' ) {
	$_SERVER['QUERY_STRING'] = rebuild_qs( $_SERVER['QUERY_STRING'] );
}
