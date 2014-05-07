$(document).ready(function () {
    $('.nav li a').each( (function() {
    	if( $(this).attr('href') === window.location.pathname){
    		$(this).parents("li").addClass("active");
    	}
    })) ;


		  // $('.nav li a').each(function() {
		  // 	alert(($(this).attr('href'));
		  //   if ($(this).attr('href')  ===  window.location.pathname) {
		  //     $(this).addClass('current');
		  //   }
		  // });
		
});

