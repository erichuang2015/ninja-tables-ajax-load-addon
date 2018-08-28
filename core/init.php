<?php
add_shortcode( 'ninja_ajax_tables', function( $atts ) {
	$atts = shortcode_atts(
		array( 'id' => -1 ),
		$atts
	);

	echo do_shortcode( '[ninja_tables id="' . $atts['id'] . '"]' );
} );

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_script( 'ninja_ajax_table', plugins_url( '../js/scripts.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
	wp_localize_script( 'ninja-ajax-table-script', 'ninja_ajax_table', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
} );


add_action( 'wp_ajax_update_ninja_ajax_tables', 'update_ninja_ajax_tables' );
add_action( 'wp_ajax_nopriv_update_ninja_ajax_tables', 'update_ninja_ajax_tables' );
function update_ninja_ajax_tables {
	die;
}