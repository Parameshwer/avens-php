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
	$results = $wpdb->get_results( '
						SELECT a.journal_name,b.category_name, a.main_category_id, a.id FROM wp_journals a, wp_journal_main_categories b WHERE a.main_category_id = b.category_id AND  a.deleted = 1
					', ARRAY_A);
	if($_GET['id']) {
       $results = $wpdb->get_results( 'SELECT 
					c.id,c.post_name,c.post_content,c.created_date,c.updated_date,c.category_id,c.journal_id,
					b.journal_name,a.category_name
					FROM 
					wp_journal_posts c,
					wp_journals b,
					wp_journal_main_categories a
					WHERE b.main_category_id=c.category_id AND a.category_id=b.main_category_id AND a.category_id=c.category_id AND c.deleted = 1
					', ARRAY_A);            
    }
	//print_r($results);
	?>
	<div class="mypluggin-main-content" style="width: 900px;">
		<h1 class="page-header">Create Journal Post</h1>
		<div class="form-box">
			<form class="form-horizontal" enctype="multipart/form-data" method="post">
				<div class="form-group">
					<label for="issn_number" class="col-sm-3 control-label">Post Name</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="journal_post_name" name="journal_post_name" value="<?php echo isset($results['0']['post_name'])?$results['0']['post_name']:''; ?>" required>
						<input type="hidden" name="id" value="<?php echo $results['0']['id']; ?>">
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
									if($results['0']['category_id'] == $value['category_id']) {
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
						<select class="form-control" name="journal_id">
							<?php 
							/*echo '<option val="">Select Journal</option>';
							foreach ($jou_res as $key => $value) {
								//echo '<option value='.$value['id'].'>'.$value['journal_name'].'</option>';
								if($results['0']['journal_id'] == $value['id']) {
								    echo '<option selected value='.$value['id'].'>'.$value['journal_name'].'</option>';
								} else {
								    echo '<option value='.$value['id'].'>'.$value['journal_name'].'</option>';
								}
							}*/
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
				<div class="form-group" required>
					<label for="banner_image" class="col-sm-3 control-label">Post Content</label>
					<div class="col-sm-9">
						<?php
						if($_GET['id']) {							
							the_editor($results['0']['post_content'], 'content');     							
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