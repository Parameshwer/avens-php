jQuery(document).ready(function(){
	jQuery(".form-horizontal").validate({
	rules: {
		name: "required"
	},
	messages: {
		name: "Please enter category name"
	}
})
});