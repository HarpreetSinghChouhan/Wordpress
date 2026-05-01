jQuery(document).ready(function() {
	

	
var jQueryroot = jQuery('html, body');
var speed = 300;
var animation = 'linear';
// main function
jQuery('.a-activer').click(function() {
  jQueryroot.animate({
    scrollTop: jQuery( jQuery.attr(this, 'href') ).offset().top
  }, speed, animation);
  return false;
});       
    //pop up form
    jQuery("form.ajax-s").validate({
        rules : {
            name : "required",
            msg : "required",
            email : {required : true,email : true },
        },
        messages : {
            name : "Please enter your name",
            msg : "Required",
            email :{ required : "Please enter mobile number", email : "please enter a valid email" },
        },
        submitHandler: function(form) {
            var that = jQuery('form.ajax-s');
            var ajax_form =  jQuery('form.ajax-s').serialize();
            var btn =  jQuery('.q_btn');
            url = that.attr('action'),
            type = that.attr('method');
            jQuery.ajax({
                url: url,
                type:"POST",
                dataType:'json',
                data: {
                    action:'set_form',
                    ajax_form: ajax_form,
                },beforeSend:function(xhr){
                    btn.html('Please Wait...');
                    btn.append('<div class="loader"></div>');
                },
                success: function(response){
                    jQuery('form.ajax-s')[0].reset();   
                    btn.html('Submit');
                    Swal.fire('Thanks for Contacting Us ..! We Will Contact You Soon...' )
                }
            });
        }
    }); 

 
             
});


jQuery( function() {
	
    jQuery( "#datepicker" ).datepicker({
        dateFormat: 'dd-M-yy',
        minDate: 0
    });
  } );