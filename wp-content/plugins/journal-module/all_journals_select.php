<?php 
$sel_op = $wpdb->get_results( '
	SELECT a.journal_name,b.category_name, a.main_category_id, a.id FROM wp_journals a, wp_journal_main_categories b WHERE a.main_category_id = b.category_id AND  a.deleted = 1
	', ARRAY_A);

	?>

	<select class="form-control" name="journal_name" onchange="navigateTo(this, 'window', false);">								
		<?php 
		echo '<option value="">Select Journal</option>';
		echo '<optgroup label="Medical"></optgroup>';
		foreach ($sel_op as $key => $value) {										
			if($value['category_name'] == 'Medical') {
				echo '<option value='.admin_url().'admin.php?page=all_archives&journal_id='.$value['id'].'>'.$value['journal_name'].'</option>';
//http://localhost/avens-php/wp-admin/admin.php?page=all_archives&journal_id=46

			} 
		}
		echo '<optgroup label="Biotechnology"></optgroup>';
		foreach ($sel_op as $key => $value) {										
			if($value['category_name'] == 'Biotechnology') {
				echo '<option value='.$value['id'].'>'.$value['journal_name'].'</option>';
			} 
		}
		echo '<optgroup label="Biology"></optgroup>';
		foreach ($sel_op as $key => $value) {										
			if($value['category_name'] == 'Biology') {
				echo '<option value='.$value['id'].'>'.$value['journal_name'].'</option>';
			} 
		}
		echo '<optgroup label="Pharmaceutical"></optgroup>';
		foreach ($sel_op as $key => $value) {										
			if($value['category_name'] == 'Pharmaceutical') {
				echo '<option value='.$value['id'].'>'.$value['journal_name'].'</option>';
			} 
		}
		?>

	</select>