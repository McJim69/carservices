$('body').append('<div id="loadingDiv"><div class="loader"></div></div>');

$(window).on('load', function(){
	setTimeout(removeLoader, 300); //wait for page load PLUS two seconds.

	});
	
	function removeLoader(){
		$( "#loadingDiv" ).fadeOut(300, function() {
		// fadeOut complete. Remove the loading div
		$( "#loadingDiv" ).remove(); //makes page more lightweight 
	});  
}
