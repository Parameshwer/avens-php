<?php
/**
* Template Name: Journal Ajax
* Description: A Page Template that adds a sidebar to pages
*
* @package WordPress
* @subpackage Twenty_Eleven
* @since Twenty Eleven 1.0
*/
//get_header();
?>
<?php
//sanitize post value
//if(isset($_GET["sort_type"])){
if(isset($_GET["sort_type"])){
	$sort_type = $_GET["sort_type"];
	if($sort_type == 'atoz'){
		global $wpdb;
		$results = $wpdb->get_results("SELECT wp_journals.journal_name,wp_journals.journal_url_slug, wp_journals.issn_number, wp_journal_main_categories.category_name FROM wp_journals INNER JOIN wp_journal_main_categories on wp_journals.main_category_id = wp_journal_main_categories.category_id ORDER BY wp_journals.journal_name", ARRAY_A );
		//print_r($results);exit;
		echo '<div class="journal-text-box"><ul><li><h3>A to Z Journal</h3><div class="post-list">';
		foreach($results as $row) { loer?>									
		<ul class="cat-ul">
			<li>
				<?php echo '<a href="http://localhost/avens-php/'.strtolower($row['category_name']).'/'.$row['journal_url_slug'].'/home">'.$row['journal_name'].'</a>'; ?>
				<span class="pull-right"><p> <span class="pull-right"><?php echo $row['issn_number']; ?></span> </p>
			</span></li>
		</ul>				
		<?php }	
	}	
}

?>