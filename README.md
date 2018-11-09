# wp-rebuild-url

This code prevents the redirection loops that WordPress URL canonicalization
causes when another layer of the stack alters the query string encoding. For
example, Varnish may re-encode portions of the query string if the VCL
manipulates it.

To make use of this workaround, place the code in `wp-config-prepend.php` either
into your PHP prepend configuration or at the beginning of `wp-config.php`.
