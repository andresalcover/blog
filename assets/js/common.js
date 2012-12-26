$(document).ready(function(){
	// make text area cleditor
	if ($('#detail').length>0) {
		$('#detail').cleditor({'width':'auto', 'height':'auto'});
	}
	// alert close button's event
	if ($('.alert .close').length>0) {
		$('.close').click(function(event){
			event.preventDefault();
			$('.alert').remove();
		});
	}
});