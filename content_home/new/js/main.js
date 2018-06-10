$(document).ready(function() {
	//scrollTo top function
	// hide #back-top first
	$(".scrollToTop").hide();

	// fade in #back-top
	$(function() {
		$(window).scroll(function() {
			if ($(this).scrollTop() > 100) {
				$('.scrollToTop').fadeIn();
			} else {
				$('.scrollToTop').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('.scrollToTop').click(function() {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
    
    
    
      // dynamic add form fields
	$(function()
	  {
		$(document).on('click', '.btn-add', function(e)
       {
         console.log('button clicked');
         e.preventDefault();

         var controlForm = $('.file-controls'),
             currentEntry = $(this).parents('.entry:first'),
             newEntry = $(currentEntry.clone()).appendTo(controlForm);

         console.log(controlForm);
         console.log(currentEntry);
         console.log(newEntry);

         newEntry.find('input').val('');
         controlForm.find('.entry:not(:last) .btn-add')
           .removeClass('btn-add').addClass('btn-remove')
           .removeClass('btn-success').addClass('btn-info')
           .html('<span class="glyphicon glyphicon-minus"></span>');
       }).on('click', '.btn-remove', function(e)
         {
           $(this).parents('.entry:first').remove();

           e.preventDefault();
           return false;
         });
	  });
    
    


	//add class on image

	$("img").addClass("img-responsive");

});
