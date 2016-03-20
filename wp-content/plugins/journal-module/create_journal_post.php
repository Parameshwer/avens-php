<?php 
function create_journal_post() {

?>
<div class="mypluggin-main-content" style="width: 900px;">
<h1 class="page-header">Create Journal Post</h1>
<div class="form-box">
<form class="form-horizontal" enctype="multipart/form-data" method="post">
<div class="form-group">
<label for="issn_number" class="col-sm-3 control-label">Post Name</label>
<div class="col-sm-9">
	<input type="email" class="form-control" id="journal_post_name" name="journal_post_name" required>
</div>
</div>
<div class="form-group">
<label for="journal_name" class="col-sm-3 control-label">Journal Name</label>
<div class="col-sm-9">
	<select class="form-control" required>
		<option value="">Select Category</option>
		<option value="Select Category">Select Category</option>
		<option value="Select Category">Select Category</option>
		<option value="Select Category">Select Category</option>
		<option value="Select Category">Select Category</option>
	</select>
</div>
</div>
<div class="form-group" required>
<label for="banner_image" class="col-sm-3 control-label">Post Content</label>
<div class="col-sm-9">
	<?php
the_editor($content, 'content');     
?>
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-3 col-sm-10">
	<button type="submit" class="btn btn-primary">Create </button>
</div>
</div>
</form>
</div>
</div>
<?php } ?>