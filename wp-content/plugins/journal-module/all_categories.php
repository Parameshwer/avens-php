<?php 
		function all_categories() {
			echo '<div class="mypluggin-main-content"><div class="form-box">';
			global $wpdb;
			$results = $wpdb->get_results( 'SELECT * FROM  wp_journal_main_categories WHERE deleted = 1', ARRAY_A );
			echo '<h1 class="page-header pull-left">All Categories <span style="font-size:15px">('.count($results).' Main Categorie(s))</span></h1>';
			?>
			<!-- Button trigger modal -->
<button type="button" class="btn btn-primary form-buttons pull-right" data-toggle="modal" data-target="#createcat_modal">Create Category</button>
			<?php
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
echo '</div></div>'; ?>


<!-- Modal -->
<div class="modal fade" id="createcat_modal" tabindex="-1" role="dialog" aria-labelledby="createcat_modalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="createcat_modalLabel">Create main Category</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal create_cat_form" method="post" novalidate="novalidate">
            <div class="form-group">
                <label for="category_name" class="col-sm-3 control-label">Category Name</label>
                <div class="col-sm-9">
                    <input type="hidden" name="category_id" value="">                 
                    <input type="text" class="form-control" id="category_name" name="category_name" required="" value="">
                </div>
            </div>			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" name="insert" value="Save" class="btn btn-primary">
      </div>
	</form>
    </div>
  </div>
</div>
<?php }

add_action('wp_ajax_my_action', 'my_ajax_action_function');

function my_ajax_action_function() {	
    $reponse = array();
    if(!empty($_POST['values'])){
         $response['response'] = "sasass";
    } else {
         $response['response'] = "You didn't send the param";
    }

    header( "Content-Type: application/json" );
    echo json_encode($response);

    exit();

}

?>

