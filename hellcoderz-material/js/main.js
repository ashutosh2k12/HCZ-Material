(function($){

	$(document).ready(function(){
		$.material.attachInputEventHandlers();

		//Primary Menu
		$('.child').hide(); //Hide children by default
		$('.parent .dropdown-toggle').click(function (event) {
			event.preventDefault();
			event.stopPropagation();

			$(this).parent().toggleClass( "open" );
			$(this).parent().children('.child').slideToggle('slow');
			$(this).find('span').toggle();
		});
	});

})(jQuery);