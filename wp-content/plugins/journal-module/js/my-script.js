jQuery(document).ready(function(){
	jQuery(".form-horizontal").validate({
	rules: {
		name: "required"
	},
	messages: {
		name: "Please enter category name"
	}
})
/*jQuery("form.create_cat_form").on( "submit", function(e) {
	//alert('aa');
	 e.preventDefault();
    jQuery.ajax({
    	url: "http://localhost/avens-php/wp-admin/admin.php?page=create_category",
    	method: "POST",
    	data: jQuery('.create_cat_form').serialize(),
    	dataType:'JSON',
    	success: function(result) {
    	    console.log(result);
	    }
	});
});*/
jQuery("form.create_cat_form").on( "submit", function(e) {
e.preventDefault();
jQuery.ajax({
    type: "POST",
    url: ajaxurl,
    data: jQuery('.create_cat_form').serializeArray()
  }).done(function( msg ) {
        // alert(msg);
         console.log(msg);
         jQuery('.modal-footer').text(msg.response);
 });
});
});
