jQuery(document).ready(function() {
      
 //jQuery("main#content").addClass("container").removeClass("site-main");
    jQuery( function() {
        jQuery( "#datepicker" ).datepicker({
            dateFormat: 'dd-M-yy',
            minDate: 0
        });
      } ); 
        $(".remove_category_filter").hide();
        $(document).on("click",".taxonony-heading",function() {
           $(this).parents(".filter_parent").find("ul.products-taxomony-child-list").toggle(  );
         });
         $('.product_quick_view').click(function(){	 
               $(this).addClass('loaaderr');
               setTimeout(function () {
                   $('.product_quick_view').removeClass("loaaderr");
                 }, 3000);
           });
           
           $('.filter_checkboox').click(function(){	
           /* 	var is_check = 	$(this).parents('.filter_parent').find('input[type="checkbox"]:checked');
               if(is_check.length > 1 ){
                   return false;
               } */
               filter_products();
           });
          
           function filter_products(){
               var filter = $('#filter');
               var loder = $('.product_filter_section');
               $.ajax({
                   url:filter.attr('action'),
                   data:filter.serialize(), // form data
                   type:filter.attr('method'), // POST
                   beforeSend:function(xhr){
                   $('body').addClass('loader_body');
                   loder.append("<div class='spinner-border'></div>");
                   $('.data_filter').removeClass('productss'); 
                   },
                   success:function(data){
                    
                    setTimeout(function(){ jQuery('.wrap_load').fadeOut() }, 1500);
                       $('body').removeClass('loader_body');
                       
                       $('.all__products').hide();
                       $('.custom_pr_filter').hide();
                       $('.spinner-border').hide();
                       $('.fillter__products').show();
                       $('.data_filter').html(data); // insert data
                       ecs_read_more();
                       $( ".products-taxomony-child-list" ).each(function() {
                        var rem_cat = $( this ).find(".remove_category_filter");
                        if( rem_cat.length > 0 ){    
                            $(this).show();
                          }
                      });
                       $('.data_filter').addClass('productss'); 
                   }
               });
           }
           
        //pop up form
        $("form.ajax").validate({
            rules : {
                name : "required",
                date : "required",
                mobile : { required : true, minlength : 10, maxlength : 10 },
                email : {required : true,email : true },
            },
            messages : {
                name : "Please enter your name",
                date : "Required",
                mobile :{ required : "Please enter mobile number", minlength : "10 digits required" },
            },
            submitHandler: function(form) {
                
                var that = $('form.ajax');
                var ajax_form =  $('form.ajax').serialize();
                alert(ajax_form);
                var btn =  $('.q_btn');
                url = that.attr('action'),
                type = that.attr('method');
                $.ajax({
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
                        $('form.ajax')[0].reset();   
                        btn.html('Submit');
                        Swal.fire('Thanks for Contacting Us ..! We Will Contact You Soon...' )
                    }
                });
            }
        });
        
        
      
});