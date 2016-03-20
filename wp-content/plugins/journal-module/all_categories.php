<?php 
		function all_categories() {
			echo '<div class="mypluggin-main-content"><div class="form-box">';
			global $wpdb;
			$results = $wpdb->get_results( 'SELECT * FROM  wp_journal_main_categories WHERE deleted = 1', ARRAY_A );
			echo '<h1 class="page-header">All Categories <span style="font-size:15px">('.count($results).' Main Categorie(s))</span></h1>';
			if(count($results) > 0) {
				echo '<table class="table table-striped">';
				echo '<tr>';
				echo '<th>Category Id</th>';
				echo '<th>Category Name</th>';
				echo '<th>Created Date</th>';
				echo '<th>Edit</th>';
				echo '<th>Delete</th>';
				echo '</tr>';
				foreach ($results as $key => $value) {

					echo '<tr>';
					echo '<td>'.$value['category_id'].'</td>';    
					echo '<td>'.$value['category_name'].'</td>';    
					echo '<td>'.$value['created_date'].'</td>';
					echo '<td><a href="'.admin_url().'admin.php?page=create_category&id='.$value['category_id'].'">Edit</a></td>';
					echo '<td><a href="'.admin_url().'admin.php?page=all_categories&id='.$value['category_id'].'">Delete</a></td>';    
					echo '</tr>';
				}
				echo '</table>';
			} else {
				echo '<div class="no-data-found-msg">No Data Found</div>';
			}
			if(isset($_GET['id'])) {	
/*$results = $wpdb->delete('wp_journal_main_categories',array( 'category_id' => $_GET['id']));
if($results) {
$message.="Main category deleted successfully";
} else {
$message.="Main category unable deleted";
}*/
$results = $wpdb->update('wp_journal_main_categories', array('deleted' => '0'), array('category_id' => $_GET['id']));      
	if($results) {
		$message.="Main category deleted successfully";
	} else {
		$message.="Main category unable to deleted";
	}
}
if (isset($message)){
	echo '<div class="col-sm-12"><div class="updated"><p>'.$message.'</p></div></div>';
}
echo '</div></div>';
}
?>

