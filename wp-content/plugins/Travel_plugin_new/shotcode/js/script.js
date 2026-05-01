jQuery(document).ready(function() {
  setTimeout(function(){ jQuery('.wrap_load').fadeOut() }, 1500);
  setTimeout(function(){ jQuery('.product_filter_section').show() }, 1500);
	jQuery('.proce li:first').find('a:first').addClass('active_r');
	jQuery('.proce1 li:first').find('a:first').addClass('active_r');
	jQuery('#faqsec0').addClass('show');
	jQuery('#incz').click(function(e){
		e.preventDefault();
		jQuery('#incz').addClass('active_r');
		jQuery('#excz').removeClass('active_r');
		jQuery('#inlusions').show();
		jQuery('#exclusions').hide();
	});
	jQuery('#excz').click(function(e){
		e.preventDefault();
		jQuery('#excz').addClass('active_r');
		jQuery('#incz').removeClass('active_r');
		jQuery('#inlusions').hide();
		jQuery('#exclusions').show();
	});
	//for tabs
	jQuery('#Booking_Proc').click(function(e){
		e.preventDefault();
		jQuery('#Booking_Proc').addClass('active_r');
		jQuery('#Cancle_Pol').removeClass('active_r');
		jQuery('#Term_and_Con').removeClass('active_r');
		jQuery('#Booking_Procudure').show();
		jQuery('#Cancle_Policy').hide();
		jQuery('#Term_and_Condition').hide();
	});
	jQuery('#Cancle_Pol').click(function(e){
		e.preventDefault();
		jQuery('#Booking_Proc').removeClass('active_r');
		jQuery('#Cancle_Pol').addClass('active_r');
		jQuery('#Term_and_Con').removeClass('active_r');
		jQuery('#Booking_Procudure').hide();
		jQuery('#Cancle_Policy').show();
		jQuery('#Term_and_Condition').hide();
	});
	jQuery('#Term_and_Con').click(function(e){
		e.preventDefault();
		jQuery('#Booking_Proc').removeClass('active_r');
		jQuery('#Cancle_Pol').removeClass('active_r');
		jQuery('#Term_and_Con').addClass('active_r');
		jQuery('#Booking_Procudure').hide();
		jQuery('#Cancle_Policy').hide();
		jQuery('#Term_and_Condition').show();
	});
	//show hide side div on scroll
	var div_h = jQuery('.package-detail').height();
	   jQuery(window).scroll(function() {
			if(div_h != ''){
				if (jQuery(this).scrollTop() > div_h-500)
     				{
        			jQuery('.package-section-price').fadeOut();
					jQuery('.package-section-priceba').fadeOut();
     				}
    			else
     				{
      				jQuery('.package-section-price').fadeIn();
					jQuery('.package-section-priceba').fadeIn();
     				}
			}
    		
 		});
		
	
jQuery(".list-btn").click(function(){
    jQuery(".all-packages-wrapper").toggleClass("package-list");
    jQuery(".inclusions").toggleClass("list-bg");

    jQuery(this).toggleClass('acctive');
    jQuery(this).toggleClass('list_gridd');
    jQuery('.acctive').html('<i class="fa fa-th-large" aria-hidden="true"></i> Grid View');
    jQuery('.list_gridd').html('<i class="fa fa-list" aria-hidden="true"></i> List View');
});

jQuery(document).on("click",".__pop_up",function(){
  var _html =   jQuery(this).parents('.all-packages-wrapper').find(".get_t").val();
  var _permalink =   jQuery(this).parents('.all-packages-wrapper').find("a").attr('href');

  jQuery(".__query").val(_html);
  jQuery("._permalink").val(_permalink);
});
jQuery(document).on("click",".__pop_upp",function(){
  var title_html =   jQuery("#sibgle_link").val();
  var titlepermalink =   jQuery("#single_title").val();
  jQuery(".__query").val(title_html);
  jQuery("._permalink").val(titlepermalink);

});

  //pop up form
  jQuery("form.ajax").validate({
    
        rules : {
            name : "required",
            date : "required",
            mobile : { required : true, minlength : 10, maxlength : 10 },
            email : {required : true,email : true },
        },
        messages : {
            name : "Please enter your name",
            date : "Required",
            email : { required : "Email Is Required" , email: "Must Be A Valid Email"},
            mobile :{ required : "Please enter mobile number", minlength : "10 digits required" , maxlength : "Can Not Be Longer Then 10 Digits" }
        },
        submitHandler: function(form) {
            var that = jQuery('form.ajax');
            var ajax_form =  jQuery('form.ajax').serialize();
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
                    jQuery('form.ajax')[0].reset();   
                    btn.html('Submit');
                    Swal.fire('Thanks for Contacting Us ..! We Will Contact You Soon...' )
                }
            });
        }
    });


jQuery(document).on("click",".slideer_btn",function() {
  jQuery(".on_load_ajax_side_bar").toggleClass( "here" );
  jQuery(".ajax_side_baar").toggleClass( "here" );

  if(jQuery(".remove_category_filter").length > 0){
    jQuery(".ajax_side_baar").toggle();
  }else{
   jQuery(".on_load_ajax_side_bar").toggle();
  }

 });
});


ecs_read_more();
function ecs_read_more(){
  if( jQuery(".rl_read_more").length > 0){
    var data_h = jQuery(".rl_read_more").height();
    if(data_h >= 100){
      
      var read_more_data = jQuery(".rl_read_more").parent();
      read_more_data.addClass("rl_read_more_parent");
      read_more_data.append('<button class="rl_btn_read btn btn_diffc">Read More</button>');
    }
  
    jQuery(document).on("click",".rl_btn_read",function(e) {
      e.preventDefault();
    
      var click_height = jQuery(this).parents(".rl_read_more_parent").find(".rl_read_more").height();
      if( click_height >= '110'){
        jQuery(this).parents(".rl_read_more_parent").find(".rl_read_more").animate({ height: '100' }, 700);
        jQuery(this).html("Read More")
        jQuery(this).removeClass("pm_read_less");
      }else {
        jQuery(this).parents(".rl_read_more_parent").find(".rl_read_more").animate({height:   jQuery(this).parents(".rl_read_more_parent").find(".rl_read_more").get(0).scrollHeight}, 700 );
        jQuery(this).html("Read Less")
        jQuery(this).addClass("pm_read_less");
      }
    });
  }
}
jQuery(window).bind("load", function() { 
	  jQuery( "main" ).removeClass( "container" );
  });

//scroll anchor active class
// Get all sections that have an ID defined

jQuery(document).ready(function () {
    jQuery(document).on("scroll", onScroll);
    
    //smoothscroll
    jQuery('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        jQuery(document).off("scroll");
        
        jQuery('a').each(function () {
            jQuery(this).removeClass('active_n');
        })
        jQuery(this).addClass('active_n');
      
        var target = this.hash,
            menu = target;
        jQuerytarget = jQuery(target);
        jQuery('html, body').stop().animate({
            'scrollTop': jQuerytarget.offset().top+2
        }, 500, 'swing', function () {
            window.location.hash = target;
            jQuery(document).on("scroll", onScroll);
        });
    });
	


});

function onScroll(event){
    var scrollPos = jQuery(document).scrollTop();
    jQuery('#myNavbar a').each(function () {
        var currLink = jQuery(this);
        var refElement = jQuery(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            jQuery('#myNavbar ul li a').removeClass("active_n");
            currLink.addClass("active_n");
        }
        else{
            currLink.removeClass("active_n");
        }
    });
}


