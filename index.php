<?php
/*
	Plugin Name:  Ninja Tables Pro - Ajax Load (Addon)
	Plugin URI:   https://github.com/git-palace/ninja-tables-ajax-load-addon
	Description:  Load ninja table as a ajax request.
*/


add_action( 'admin_init', function () {
	if ( !is_plugin_active( 'ninja-tables/ninja-tables.php' ) )
		deactivate_plugins( 'ninja-tables-ajax-load-addon/index.php' );
});

require_once( 'core/init.php' );