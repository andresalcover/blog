
$(document).ready(function(){
	// make text area cleditor
	if ($('#detail').length>0) {
		$('#detail').cleditor();
	}
	
	// alert close button's event
	if ($('.alert .close').length>0) {
		$('.close').click(function(event){
			event.preventDefault();
			$('.alert').remove();
		});
	}
});