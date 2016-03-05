<?php 


function create_journal() {
global $wpdb;
$results = $wpdb->get_results( 'SELECT * FROM  wp_journal_main_categories', ARRAY_A );
?>
<div class="mypluggin-main-content">
<h1 class="page-header">Create Journal</h1>
<div class="form-box">
    <form class="form-horizontal" id="journal_form" enctype="multipart/form-data" method="post">
        <div class="form-group">
            <label for="journal_name" class="col-sm-3 control-label">Journal Name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="journal_name" name="journal_name" required>
            </div>
        </div>
        <div class="form-group">
            <label for="issn_number" class="col-sm-3 control-label">Issn Number</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="issn_number" name="issn_number" required>
            </div>
        </div>
        <div class="form-group">
            <label for="banner_image" class="col-sm-3 control-label">Banner Image</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" id="banner_image" name="banner_image" required>
            </div>
        </div>
        <div class="form-group">
            <label for="sidebar_image" class="col-sm-3 control-label">Sidebar Image</label>
            <div class="col-sm-9">
                <input type="file" class="form-control" id="sidebar_image" name="sidebar_image" required>
            </div>
        </div>
        <div class="form-group">
            <label for="journal_meta_keywords" class="col-sm-3 control-label">Journal Meta Keywords</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="journal_meta_keywords" name="journal_meta_keywords" required>
            </div>
        </div>
        <div class="form-group">
            <label for="journal_ic_value" class="col-sm-3 control-label">Journal Ic Value</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="journal_ic_value" name="journal_ic_value" required>
            </div>
        </div>
        <div class="form-group">
            <label for="main_category" class="col-sm-3 control-label">Main Category</label>
            <div class="col-sm-9">
                <select class="form-control">
                    <?php 
                    	echo '<option>Select category</option>';
                        foreach ($results as $key => $value) {	                                	
	echo '<option value='.$value['category_id'].'>'.$value['category_name'].'</option>';
						}
					?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="journal_description" class="col-sm-3 control-label">Journal Description</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="journal_description" name="journal_description">
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