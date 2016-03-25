<?php
function all_journals() {
	echo '<div class="mypluggin-main-content"><div class="form-box">';
	global $wpdb;
	//$res = $wpdb->get_results( 'SELECT * FROM  wp_journal_main_categories', ARRAY_A );
	$results = $wpdb->get_results( 'SELECT * FROM wp_journals INNER JOIN wp_journal_main_categories ON wp_journals.main_category_id = wp_journal_main_categories.category_id', ARRAY_A);
	//print_r($res);exit;
	//$results = $wpdb->get_results( 'SELECT * FROM  wp_journals WHERE deleted = 1', ARRAY_A );
	echo '<h1 class="page-header">All Journals <span style="font-size:15px">'.count($results).' Journal(s)</span></h1>';
	if(count($results) > 0) {
		echo '<table class="table table-striped">';
		echo '<tr>';
		echo '<th>Journal Name</th>';
		echo '<th>Journal Meta Keywords</th>';
		echo '<th>Journal Category</th>';
		echo '<th>Journal Ic value</th>';
		echo '<th>Banner Image</th>';
		echo '<th>Sidebar Image</th>';
		echo '<th>Journal Description</th>';
		echo '<th>Created Date</th>';
		echo '<th>Edit</th>';
		echo '<th>Delete</th>';
		echo '</tr>';
		foreach ($results as $key => $value) {

			echo '<tr>';
			echo '<td>'.$value['journal_name'].'</td>';    
			echo '<td>'.$value['journal_meta_keywords'].'</td>';
			echo '<td>'.$value['category_name'].'</td>';
			echo '<td>'.$value['journal_ic_value'].'</td>';
			echo '<td><img src="'.$value['banner_image'].'" alt="" width="60px" height="60px" /></td>';
			echo '<td><img src="'.$value['sidebar_image'].'" alt=""  width="60px" height="60px" /></td>';
			echo '<td>'.$value['journal_description'].'</td>';					

			echo '<td>'.$value['created_date'].'</td>';
			echo '<td><a href="'.admin_url().'admin.php?page=create_journal&id='.$value['id'].'">Edit</a></td>';
			echo '<td><a href="'.admin_url().'admin.php?page=all_journals&id='.$value['id'].'">Delete</a></td>';    
			echo '</tr>';
		}
		echo '</table>';
	} else {
		echo '<div class="no-data-found-msg">No Data Found</div>';
	}
	if(isset($_GET['id'])) {	

		$results = $wpdb->update('wp_journals', array('deleted' => '0'), array('id' => $_GET['id']));      
		if($results) {
			$message.="Journal deleted successfully";
			/*header("Location: http://localhost/avens-php/wp-admin/admin.php?page=all_journals");
            die();*/
            /*print_r($_SERVER[PHP_SELF]);
            header("Location: $_SERVER[PHP_SELF]",true);exit;*/
            //wp_redirect(admin_url(),true); exit;
		} else {
			$message.="Journal unable to deleted";
		}
	}
	if (isset($message)){
		echo '<div class="col-sm-12"><div class="updated"><p>'.$message.'</p></div></div>';
	}
	echo '</div></div>';
}
?>

