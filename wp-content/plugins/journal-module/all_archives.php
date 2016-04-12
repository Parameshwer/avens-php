<?php
function all_archives() {
	echo '<div class="mypluggin-main-content"><div class="form-box">';
	global $wpdb;
	if($_GET['move_id'] && $_GET['journal_id']){		
		$updated_date = date("Y-m-d");
		$archive_in = $_GET['move_id'];
		 $res = $wpdb->update( 
                'wp_journal_archives',
                array(
                	'updated_date' => $updated_date,
                	'archive_in' => $archive_in
                	),
                array( 'id' => $_GET['archive_id'])
               );		 
		  if($res) {
                $message.="Archive Moved successfully";
            } else {
                $message.="Archive uanble Move";
            }

$results = $wpdb->get_results( 'SELECT a.id, a.archive_doi,a.archive_year,a.archive_volume, a.archive_fulltext,a.archive_pdf,a.archive_in, a.created_date,b.journal_name, c.category_name FROM 
		wp_journal_archives a, 
		wp_journals b, 
		wp_journal_main_categories c
		WHERE a.journal_id = b.id AND b.main_category_id = c.category_id AND a.deleted = 1 AND a.journal_id = "'.$_GET['journal_id'].'"', ARRAY_A);
	}
	else if($_GET['journal_id']){

		$results = $wpdb->get_results( 'SELECT a.id, a.archive_doi,a.archive_year,a.archive_volume, a.archive_fulltext,a.archive_pdf,a.archive_in, a.created_date,b.journal_name, c.category_name FROM 
		wp_journal_archives a, 
		wp_journals b, 
		wp_journal_main_categories c
		WHERE a.journal_id = b.id AND b.main_category_id = c.category_id AND a.deleted = 1 AND a.journal_id = "'.$_GET['journal_id'].'"', ARRAY_A);
	}
	else {
		$results = $wpdb->get_results( 'SELECT a.id, a.archive_doi,a.archive_year,a.archive_volume, a.archive_fulltext,a.archive_pdf,a.archive_in, a.created_date,b.journal_name, c.category_name FROM 
		wp_journal_archives a, 
		wp_journals b, 
		wp_journal_main_categories c
		WHERE a.journal_id = b.id AND b.main_category_id = c.category_id AND a.deleted = 1', ARRAY_A);
	}
	 ?>
		<div class="row">
		<div class="col-sm-4" style="margin-top: 50px">		
		<?php include('all_journals_select.php'); ?>
		</div>
		</div>

		<?php 

		echo '<h1 class="page-header">All Archives <span style="font-size:15px">'.count($results).' Archive(s)</span></h1>';
		if(count($results) > 0) {
			echo '<table class="table table-striped">';
			echo '<tr>';		
			echo '<th>Journal Name</th>';
			echo '<th>Category Name </th>';
			//echo '<th>Archive DOI</th>';
			echo '<th>Archive Volume</th>';
			echo '<th>Archive In </th>';
			echo '<th>Archive Year</th>';
			echo '<th>Created Date</th>';			
			echo '<th>Edit</th>';
			echo '<th>Delete</th>';		
			echo '<td>Move Archive</td>';				

			echo '</tr>';
			foreach ($results as $key => $value) {

				echo '<tr>';			
				echo '<td>'.$value['journal_name'].'</td>';
				echo '<td>'.$value['category_name'].'</td>';
				//echo '<td>'.$value['archive_doi'].'</td>';
				echo '<td>'.$value['archive_volume'].'</td>';
				if($value['archive_in'] == '1'){
					echo '<td>Article In Press</td>';				
				} elseif($value['archive_in'] == '2') {
					echo '<td>current Issue</td>';
				} elseif ($value['archive_in'] == '3') {
					echo '<td>Archives</td>';
				}
				echo '<td>'.$value['archive_year'].'</td>';
				echo '<td>'.$value['created_date'].'</td>';					
				echo '<td><a href="'.admin_url().'admin.php?page=create_archive&id='.$value['id'].'">Edit</a></td>';
				echo '<td><a href="'.admin_url().'admin.php?page=all_archives&id='.$value['id'].'">Delete</a></td>';    
				//if($value['archive_in'] == '1' || $value['archive_in'] == '2') {
				 ?>
					
					<td><select class="form-control" onchange="navigateTo(this, 'window', false)">
					<?php 
					echo '<option value="">Move Archive</option>';
					echo '<option value="'.admin_url().'admin.php?page=all_archives&move_id=1&journal_id='.$value['id'].'&archive_id='.$value['id'].'">Article In Press</option>';
					echo '<option value="'.admin_url().'admin.php?page=all_archives&move_id=2&journal_id='.$value['id'].'&archive_id='.$value['id'].'">Current Issue</option>';
					echo '<option value="'.admin_url().'admin.php?page=all_archives&move_id=3&journal_id='.$value['id'].'&archive_id='.$value['id'].'">Archives</option>';						
					echo '</select></td>';
				//}
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
	echo '</div></div>'; ?>

	<script type="text/javascript">
	function navigateTo(sel, target, newWindow) {		
	    var url = sel.options[sel.selectedIndex].value;
	    if (newWindow) {
	        window.open(url, target, '--- attributes here, see below ---');
	    } else {
	        window[target].location.href = url;
	    }
}
</script>
<?php if (isset($message)){ ?>
<div class="col-sm-12">
    <div class="updated"><p><?php echo $message;?></p></div>
</div>
<?php } ?>
<?php }
?>

