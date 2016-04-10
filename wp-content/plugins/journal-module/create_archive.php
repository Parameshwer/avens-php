<?php 
function create_archive() { 
	global $wpdb;


	if($_POST['insert']) {
		$journal_id = $_POST['journal_name'];
		$category_id = $_POST['category_id'];
        $archive_desc = $_POST['archive_desc'];
        $archive_doi = $_POST['archive_doi'];
        $archive_year = $_POST['archive_year'];        
        $archive_volume = $_POST['archive_volume'];
        $archive_fulltext = $_POST['archive_fulltext'];
        $archive_pdf = $_POST['archive_pdf'];        
        $created_date = date("Y-m-d");
        $updated_date = date("Y-m-d");

        //echo $acrchive_pdf;exit;
        $wpdb->insert('wp_journal_archives', array(
        	'journal_id' => $journal_id,
        	'category_id' => $category_id,
        	'archive_desc' => $archive_desc,
        	'archive_doi' => $archive_doi,
        	'archive_year' => $archive_year,
        	'archive_volume' => $archive_volume,
        	'archive_fulltext' => $archive_fulltext,
        	'archive_pdf' => $archive_pdf,
        	'created_date' => $created_date,
        	'updated_date' => $updated_date,
        	'archive_in' => '1'
        ));
        
        if($wpdb->insert_id) {
            $message.="Journal Archive created successfully";
        } else {
        	$message.="Journal Archive unable to created";
        }
	}
	if($_GET['id']) {
        $edit_vals = $wpdb->get_results( 'SELECT * FROM  wp_journal_archives WHERE id = "'.$_GET['id'].'"', ARRAY_A );   
        
    }

	$results = $wpdb->get_results( '
		SELECT a.journal_name,b.category_name, a.main_category_id, a.id FROM wp_journals a, wp_journal_main_categories b WHERE a.main_category_id = b.category_id AND  a.deleted = 1
		', ARRAY_A);
		$cat_res = $wpdb->get_results( 'SELECT * FROM  wp_journal_main_categories', ARRAY_A );
		?>
		<div class="mypluggin-main-content">
			<h1 class="page-header">Create Archive</h1>
			<div class="form-box">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<button class="btn btn-primary" id="archive-btn">Add a Archive</button>
						</div><hr>
						<form class="form-horizontal" id="archive_form" enctype="multipart/form-data" method="post" novalidate="novalidate">
						<div class="form-group">
							<label for="journal_name" class="col-sm-3 control-label">Select Category</label>
							<div class="col-sm-9">
							<select class="form-control" name="category_id">
								<?php 
								echo '<option val="">Select Category</option>';
									foreach ($cat_res as $key => $value) {
										if($edit_vals['0']['category_id'] == $value['category_id']) {
						                    echo '<option selected value='.$value['category_id'].'>'.$value['category_name'].'</option>';
						                } else {
						                    echo '<option value='.$value['category_id'].'>'.$value['category_name'].'</option>';
						                }                                   
									}
								?>
							</select>
					</div>
						</div>
							<div class="form-group">
								<label for="journal_name" class="col-sm-3 control-label">Select Journal</label>
								<div class="col-sm-9">
									<select class="form-control" name="journal_name" required>								
										<?php 
										echo '<option value="">Select Journal</option>';
										echo '<optgroup label="Medical"></optgroup>';
										foreach ($results as $key => $value) {										
											if($value['category_name'] == 'Medical') {
												echo '<option value='.$value['id'].'>'.$value['journal_name'].'</option>';
											} 
										}
										echo '<optgroup label="Biotechnology"></optgroup>';
										foreach ($results as $key => $value) {										
											if($value['category_name'] == 'Biotechnology') {
												echo '<option value='.$value['id'].'>'.$value['journal_name'].'</option>';
											} 
										}
										echo '<optgroup label="Biology"></optgroup>';
										foreach ($results as $key => $value) {										
											if($value['category_name'] == 'Biology') {
												echo '<option value='.$value['id'].'>'.$value['journal_name'].'</option>';
											} 
										}
										echo '<optgroup label="Pharmaceutical"></optgroup>';
										foreach ($results as $key => $value) {										
											if($value['category_name'] == 'Pharmaceutical') {
												echo '<option value='.$value['id'].'>'.$value['journal_name'].'</option>';
											} 
										}
										?>

									</select>
								</div>
							</div>
							<!-- <div class="form-group">
								<label for="journal_name" class="col-sm-3 control-label">Archive Description</label>
								<div class="col-sm-9">							
									<textarea name="archive_desc" id="archive_desc" class="form-control" required ></textarea>
								</div>
							</div> -->
							<div class="form-group" required>
								<label for="archive_desc" class="col-sm-3 control-label">Archive Description</label>
								<div class="col-sm-9">
									<?php
									if($_GET['id']) {							
										the_editor($edit_vals['0']['archive_desc'], 'archive_desc');     							
									}else {
										the_editor($content, 'archive_desc');
									}
									?>
								</div>
							</div>
							<div class="form-group">
								<label for="journal_name" class="col-sm-3 control-label">Archive DOI</label>
								<div class="col-sm-9">
									<input type="text" name="archive_doi" required id="archive_doi" class="form-control"  value="<?php echo isset($edit_vals['0']['archive_doi'])?$edit_vals['0']['archive_doi']:''; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="journal_name" class="col-sm-3 control-label">Archive Year</label>
								<div class="col-sm-9">
									<select class="form-control" name="archive_year" required>
										<option value="">Select a year</option>
										<?php for ($i=2000; $i <=  date("Y") ; $i++) {
										if($results['0']['archive_year'] == $i) {
											echo '<option selected value='.$i.'>'.$i.'</option>';											
										} else {
											echo '<option value='.$i.'>'.$i.'</option>';
										} 
										} ?>
									</select>
								</div>
							</div>
							<!-- <div class="form-group">
								<label for="journal_name" class="col-sm-3 control-label">Archive Author</label>
								<div class="col-sm-9">
									<input type="text" name="archive_author" id="archive_author" class="form-control" required />
								</div>
							</div> -->
							<div class="form-group">
								<label for="journal_name" class="col-sm-3 control-label">Archive Volume</label>
								<div class="col-sm-9">
									<select class="form-control" name="archive_volume" required>
										<option value="">Select a Volume</option>
										<option value="volume-1-issue-1">Volume 1 Issue 1</option>
										<option value="volume-1-issue-2">Volume 1 Issue 2</option>
										<option value="volume-2-issue-1">Volume 2 Issue 1</option>
										<option value="volume-2-issue-2">Volume 2 Issue 2</option>
										<option value="volume-3-issue-1">Volume 3 Issue 1</option>
										<option value="volume-3-issue-2">Volume 3 Issue 2</option>
										<option value="volume-4-issue-1">Volume 4 Issue 1</option>
										<option value="volume-4-issue-2">Volume 4 Issue 2</option>

									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="archive_fulltext" class="col-sm-3 control-label">Archive Fulltext</label>

								<div class="col-sm-9">
									<input type="text" name="archive_fulltext" id="archive_fulltext" class="regular-text" value="" required>
									<input type="button" name="upload-btn" id="full-upload-btn" class="button-secondary" value="Upload Full Text">
									<?php 
									wp_enqueue_script('jquery');
									wp_enqueue_media();
									?>                        
								</div>
							</div>
							<div class="form-group">
								<label for="archive_pdf" class="col-sm-3 control-label">Archive PDF</label>
								<div class="col-sm-9">
									<input type="text" name="archive_pdf" id="archive_pdf" class="regular-text" value="<?php echo isset($edit_vals['0']['archive_pdf'])?$edit_vals['0']['archive_pdf']:''; ?>" required>
									<input type="button" name="upload-btn" id="pdf-upload-btn" class="button-secondary" value="Upload PDF" required>
									<?php 
									wp_enqueue_script('jquery');
									wp_enqueue_media();
									?>                        
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"></label>
								<div class="col-sm-9">
									<input type="submit" name="insert" value="Create Archive" class="btn btn-primary">
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('.button-secondary').click(function(e) {
					var ME = $(e.target);
					e.preventDefault();
					var image = wp.media({ 
						title: 'Upload Image',
						multiple: false
					}).open()
					.on('select', function(e){
						var uploaded_image = image.state().get('selection').first();

						var image_url = uploaded_image.toJSON().url;

						ME.closest('.form-group').find('.regular-text').val(image_url);
					});
				});
				$('#archive-btn').click(function(){
					$('#archive_form').toggle('100');
				});
			});
		</script>
		<?php if (isset($message)){ ?>
		<div class="col-sm-12">
		    <div class="updated"><p><?php echo $message;?></p></div>
		</div>
		<?php } ?>
		<?php } ?>

