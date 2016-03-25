<?php
function all_journal_posts() {
	echo '<div class="mypluggin-main-content"><div class="form-box">';
	global $wpdb;
	//$res = $wpdb->get_results( 'SELECT * FROM  wp_journal_main_categories', ARRAY_A );
	$results = $wpdb->get_results( 'SELECT 
c.id,c.post_name,c.post_content,c.created_date,c.updated_date,c.category_id,c.journal_id,
b.journal_name,a.category_name
FROM 
wp_journal_posts c,
wp_journals b,
wp_journal_main_categories a
WHERE b.main_category_id=c.category_id AND a.category_id=b.main_category_id AND a.category_id=c.category_id
 AND c.deleted = 1', ARRAY_A);
	//print_r($results);exit;
	//$results = $wpdb->get_results( 'SELECT * FROM  wp_journals WHERE deleted = 1', ARRAY_A );
	echo '<h1 class="page-header">All Journals Post <span style="font-size:15px">'.count($results).' Journal(s)</span></h1>';
	if(count($results) > 0) {
		echo '<table class="table table-striped">';
		echo '<tr>';
		echo '<th>Post Name</th>';
		echo '<th>Journal</th>';
		echo '<th>Category</th>';
		echo '<th>Created date</th>';
		echo '<th>Updated date</th>';		
		echo '<th>Edit</th>';
		echo '<th>Delete</th>';				
		echo '</tr>';
		foreach ($results as $key => $value) {

			echo '<tr>';
			echo '<td>'.$value['post_name'].'</td>';    
			echo '<td>'.$value['journal_name'].'</td>';    
			echo '<td>'.$value['category_name'].'</td>';
			echo '<td>'.$value['created_date'].'</td>';
			echo '<td>'.$value['updated_date'].'</td>';  
			echo '<td><a href="'.admin_url().'admin.php?page=create_journal_post&id='.$value['id'].'">Edit</a></td>';
			echo '<td><a href="'.admin_url().'admin.php?page=all_journal_posts&id='.$value['id'].'">Delete</a></td>';
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<div class="no-data-found-msg">No Data Found</div>';
	}
	if(isset($_GET['id'])) {	

		$results = $wpdb->update('wp_journal_posts', array('deleted' => '0'), array('id' => $_GET['id']));      
		if($results) {
			$message.="Journal Post deleted successfully";
			/*header("Location: http://localhost/avens-php/wp-admin/admin.php?page=all_journals");
            die();*/
            /*print_r($_SERVER[PHP_SELF]);
            header("Location: $_SERVER[PHP_SELF]",true);exit;*/
            //wp_redirect(admin_url(),true); exit;
		} else {
			$message.="Journal Post unable to deleted";
		}
	}
	if (isset($message)){
		echo '<div class="col-sm-12"><div class="updated"><p>'.$message.'</p></div></div>';
	}
	echo '</div></div>';
}
?>

