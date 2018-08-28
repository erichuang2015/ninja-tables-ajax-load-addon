(function($) {

	if ( $('table.ninja_ajax_table_pro').length ) {

		setTimeout( function() {

			$('table.ninja_ajax_table_pro').each( function( idx, selector ) {
				
				let table_id = $(selector).attr('id').split('_').pop();

				let thead = $(selector).find('thead').html();

				setInterval( function() {

					let data = { 'action': 'update_ninja_ajax_tables', 'table_id': table_id };

					$.post( ninja_ajax_tables.ajax_url, data, function( response ) {
						
						$(selector).find( 'tbody' ).html( response );

						$(selector).footable();

						if ( $(selector).find( 'thead' ).length )
							$(selector).find( 'thead' ).html( thead );
						else
							$(selector).prepend( '<thead>' + thead + '</thead>' );

					} );

				}, 5000 );

			}, 5000 );

		} );
	}

})(jQuery);