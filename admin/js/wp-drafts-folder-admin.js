(function( $ ) {
	'use strict';

	$(function() {
		$( '#wpdf-type-filter' ).on( 'change', function() {
			var selected = $( this ).val();
			var $items   = $( '.wpdf-draft-item' );
			if ( selected === 'all' ) {
				$items.show();
			} else {
				$items.hide().filter( '[data-post-type="' + selected + '"]' ).show();
			}
		} );
	});

})( jQuery );
