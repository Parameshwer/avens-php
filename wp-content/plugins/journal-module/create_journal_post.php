<?php 
function create_journal_post() {
	global $wpdb;

	 if($_POST['insert']) {
	 	//print_r($_POST);exit;
        $post_name = $_POST['journal_post_name'];
        $created_date = date("Y-m-d");
        $updated_date = date("Y-m-d");
        $category_id = $_POST['category_id'];
        $journal_id = $_POST['journal_id'];
        $post_slug = $_POST['journal_post_slug'];
        $journal_slug = $_POST['journal_slug'];
        $post_content = $_POST['content'];    
        if($_POST['id']) {
            $results = $wpdb->update( 
                'wp_journal_posts', 
                array( 
                    'post_name' => $post_name,
                    'created_date' => $created_date,
                    'updated_date' => $updated_date,
                    'category_id' => $category_id,
                    'journal_id' => $journal_id,
                    'post_slug' => $post_slug,
                    'journal_slug' => $journal_slug,
                    'post_content' => $post_content
                    ), 
                array( 'id' => $_GET['id'])  
                );
                //print_r($results);      
            if($results) {
                $message.="Journal Post updated successfully";                
            } else {
                $message.="Journal Post unable to update";
            }
        } else {

            $wpdb->insert( 'wp_journal_posts', array(
					'post_name' => $post_name,
					'created_date' => $created_date,
					'updated_date' => $updated_date,
					'category_id' => $category_id,
					'journal_id' => $journal_id,
					'post_slug' => $post_slug,
                    'journal_slug' => $journal_slug,
					'post_content' => $post_content
                )
            );
            //print_r($wpdb->insert_id);exit();
            if($wpdb->insert_id) {
                $message.="Journal Post created successfully";
            }
        }

    }

	$cat_res = $wpdb->get_results( 'SELECT * FROM  wp_journal_main_categories', ARRAY_A );
	//$jou_res = $wpdb->get_results( 'SELECT id,journal_name FROM  wp_journals', ARRAY_A );
	$temp = $wpdb->get_results( '
						SELECT a.journal_name,b.category_name, a.main_category_id, a.id FROM wp_journals a, wp_journal_main_categories b WHERE a.main_category_id = b.category_id AND  a.deleted = 1
					', ARRAY_A);

	if($_GET['id']) {
       /*$edit_results = $wpdb->get_results('
       	SELECT jp.id,jp.post_name, jp.category_id, jp.journal_id, jp.post_content,mc.category_name, j.journal_name,jp.created_date, jp.updated_date FROM wp_journal_posts jp INNER JOIN wp_journals j on jp.journal_id = j.id INNER JOIN wp_journal_main_categories mc on j.main_category_id = mc.category_id WHERE jp.deleted = 1 AND jp.id="'.$_GET['id'].'"', ARRAY_A);*/  
       	$edit_results = $wpdb->get_results( 'SELECT * FROM wp_journal_posts WHERE deleted=1 AND id="'.$_GET['id'].'"', ARRAY_A); 
       	//print_r($edit_results);exit;         
    }
	//print_r($edit_results);
	?>
	<div class="mypluggin-main-content" style="width: 900px;">
		<h1 class="page-header">Create Journal Post</h1>
		<div class="form-box">
			<form class="form-horizontal" enctype="multipart/form-data" method="post">
				<div class="form-group">
					<label for="issn_number" class="col-sm-3 control-label">Post Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="journal_post_name" name="journal_post_name" value="<?php echo isset($edit_results['0']['post_name'])?$edit_results['0']['post_name']:''; ?>"
						onblur="convertToPostSlug(jQuery(this).val())" required>
						<input type="hidden" name="id" value="<?php echo $edit_results['0']['id']; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="issn_number" class="col-sm-3 control-label">Post Slug</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="journal_post_slug" name="journal_post_slug" value="<?php echo isset($edit_results['0']['post_slug'])?$edit_results['0']['post_slug']:''; ?>" required>					
					</div>
				</div>
				<div class="form-group">
					<label for="journal_name" class="col-sm-3 control-label">Main Category Name</label>
					<div class="col-sm-9">
						<select class="form-control" name="category_id">
							<?php 
							echo '<option val="">Select Category</option>';
								foreach ($cat_res as $key => $value) {
									//echo '<option value='.$value['category_id'].'>'.$value['category_name'].'</option>';
									if($edit_results['0']['category_id'] == $value['category_id']) {
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
					<label for="journal_name" class="col-sm-3 control-label">Journal Name</label>
					<div class="col-sm-9">
<select class="form-control" name="journal_id" id="journal_name" onblur="convertToJournalSlug(jQuery('#journal_name option:selected').text())">
							<?php 
							echo '<option value="">Select Journal</option>';
							    echo '<optgroup label="Medical"></optgroup>';
								foreach ($temp as $key => $value) {										
										if($value['category_name'] == 'Medical') {
											if($edit_results['0']['journal_id'] == $value['id']) {
									  			echo '<option selected value='.$value['id'].'>'.$value['journal_name'].'</option>';
									  		} else {
									  			echo '<option value='.$value['id'].'>'.$value['journal_name'].'</option>';
									  		}
										} 
								}
								echo '<optgroup label="Biotechnology"></optgroup>';
								foreach ($temp as $key => $value) {										
										if($value['category_name'] == 'Biotechnology') {
											if($edit_results['0']['journal_id'] == $value['id']) {
									  			echo '<option selected value='.$value['id'].'>'.$value['journal_name'].'</option>';
									  		} else {
									  			echo '<option value='.$value['id'].'>'.$value['journal_name'].'</option>';
									  		}
										} 
								}
								echo '<optgroup label="Biology"></optgroup>';
								foreach ($temp as $key => $value) {										
										if($value['category_name'] == 'Biology') {
											if($edit_results['0']['journal_id'] == $value['id']) {
									  			echo '<option selected value='.$value['id'].'>'.$value['journal_name'].'</option>';
									  		} else {
									  			echo '<option value='.$value['id'].'>'.$value['journal_name'].'</option>';
									  		}
										} 
								}
								echo '<optgroup label="Pharmaceutical"></optgroup>';
								foreach ($temp as $key => $value) {										
										if($value['category_name'] == 'Pharmaceutical') {
											if($edit_results['0']['journal_id'] == $value['id']) {
									  			echo '<option selected value='.$value['id'].'>'.$value['journal_name'].'</option>';
									  		} else {
									  			echo '<option value='.$value['id'].'>'.$value['journal_name'].'</option>';
									  		}
										} 
								}

							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="issn_number" class="col-sm-3 control-label">Jounral Slug</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="journal_slug" name="journal_slug" value="<?php echo isset($edit_results['0']['journal_slug'])?$edit_results['0']['journal_slug']:''; ?>" required>					
					</div>
				</div>
				<div class="form-group" required>
					<label for="banner_image" class="col-sm-3 control-label">Post Content</label>
					<div class="col-sm-9">
						<?php
						if($_GET['id']) {							
							the_editor($edit_results['0']['post_content'], 'content');     							
						}else {
							the_editor($content, 'content');
						}
						?>
					</div>
				</div>
				<div class="form-group">
					 <div class="col-sm-offset-3 col-sm-10">
				        <input type='submit' name="insert" value='Save' class='btn btn-primary'>
				    </div>
				</div>
			</form>
		</div>
	</div>
	<?php if (isset($message)){ ?>
	<div class="col-sm-12">
	    <div class="updated"><p><?php echo $message;?></p></div>
	</div>
	<?php } ?>
	<?php } ?>
<script type="text/javascript">
	function convertToPostSlug(Text)
    {
        jQuery('#journal_post_slug').val(Text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-'));
    }
    function convertToJournalSlug(Text)
    {
        jQuery('#journal_slug').val(Text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-'));
    }
</script>