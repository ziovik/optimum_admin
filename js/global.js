$('.form_disable').on('submit' , function(){
	var self = $(this),
	   button = self.find('input[type="submit"], button');  // selector reference to the input button
	  

	button.attr('disabled', 'disabled').val('wait') ;  // add attrr name and value of attr



	return false;
});