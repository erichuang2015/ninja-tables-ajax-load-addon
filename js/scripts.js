(function($) {

	if ( $('table.ninja_ajax_table_pro').length ) {

		setTimeout( function() {

			$('table.ninja_ajax_table_pro').each( function( idx, selector ) {
				
				let table_id = $(selector).attr('id').split('_').pop();

				setInterval( function() {

					let data = { 'action': 'update_ninja_ajax_tables', 'table_id': table_id };

					$.post( ninja_ajax_tables.ajax_url, data, function( response ) {

						let result = JSON.parse( response );

						$(selector).find('thead').html( result.thead );

						$(selector).find('tbody').html( result.tbody );

						$(selector).footable({
							"columns": result.columns,
							"cascade": true,
							"expandFirst": false,
							"expandAll": false,
							"empty": "No Result Found",
							"sorting": { "enabled": true },
							"filtering": { 
								"enabled": true, 
								"delay": 1, 
								"dropdownTitle": "Search in",
								"placeholder":"Search",
								"connectors":false,
								"ignoreCase":true
							},
							"paging": {
								"enabled": true,
								"position": "right",
								"size": "20",
								"container": "#footable_parent_" + table_id +" .paging-ui-container" 
							}
						});

					} );

				}, 5000 );

			}, 5000 );

		} );
	}

})(jQuery);