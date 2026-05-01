jQuery(document).ready( function () {

    jQuery('#table_id').DataTable();

    jQuery(document).on("click",".del_query",function(){
        var id = jQuery(this).attr("id");
        console.log(id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              jQuery(this).parents('tr').remove();
              jQuery.ajax({
                type: 'POST',
                url: ajaxurl,
                data: {"action": "your_delete_action", "element_id": id},
                success: function (data) {
                }
            });
            }
          })
 
    });
} );
