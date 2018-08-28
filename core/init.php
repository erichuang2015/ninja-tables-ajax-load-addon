<?php
add_shortcode( 'ninja_ajax_tables', function( $atts ) {
	$atts = shortcode_atts(
		array( 'id' => -1 ),
		$atts
	);

	$table_content = do_shortcode( '[ninja_tables id="' . $atts['id'] . '"]' );

	$table_content = str_replace( 'ninja_table_pro', 'ninja_ajax_table_pro ninja_table_pro', $table_content );

	echo $table_content;
} );

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_script( 'ninja-ajax-table-script', plugins_url( '../js/scripts.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
	wp_localize_script( 'ninja-ajax-table-script', 'ninja_ajax_tables', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
} );


add_action( 'wp_ajax_update_ninja_ajax_tables', 'update_ninja_ajax_tables' );
add_action( 'wp_ajax_nopriv_update_ninja_ajax_tables', 'update_ninja_ajax_tables' );
function update_ninja_ajax_tables() {

	$table_id = $_POST['table_id'];

	$xml = simplexml_load_string( do_shortcode( '[ninja_tables id="' . $table_id . '"]' ) );

	$opt_col_arr = array();

	foreach ( $xml->table->thead->tr->th as $th_tag ) {

		$opt_col = array(
			'name'	=> str_replace( '-', '_', sanitize_title( $th_tag[0]->__toString() ) ),
			'title'	=> $th_tag[0]->__toString(),
			'type'	=> 'text',
			'visible'		=> true,
			'sortable'	=> true,
			'classes'		=> $th_tag[0]->attributes()['class']->__toString(),
			'filterable'	=> true,
			'breakpoints'	=> ''
		);

		array_push( $opt_col_arr, $opt_col );

	}

	$thead_content = '';
	$tbody_content = '';

	foreach ( $xml->table->thead->tr as $tr_tag ) {

		$thead_content .= $tr_tag->asXML();

	}


	foreach ( $xml->table->tbody->tr as $tr_tag ) {

		$tbody_content .= $tr_tag->asXML();

	}

	echo json_encode( array( 
		'thead' => $thead_content, 
		'tbody' => $tbody_content,
		'columns'	=> $opt_col_arr
	) );

	die;

}