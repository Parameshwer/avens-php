<?php
/**
* The template for displaying 404 pages (not found)
*
* @package WordPress
* @subpackage Twenty_Sixteen
* @since Twenty Sixteen 1.0
*/

get_header(); ?>
<?php
$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
if($segments[2] == 'medical' || $segments[2] == 'biotechnology' || $segments[2] == 'pharmaceutical' || $segments[2] == 'biotechnology') { 
$journal_pages = array("Home"=> "home", "Aims & Scope" => "aims-scope", "Editorial Board" => "editorial-board","Instructions to Author" => "instructions-to-author","Manuscript Work Flow" => "manuscript-work-flow","Current Issue" => "current-issue","Articles in Press" =>"articles-in-press","Archive" => "archive");
?>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<!-- <div class=" affix-top" data-spy="affix" data-offset-top="300" > -->
			<div class="mobile-category-nav visible-xs">
				<a href="#" id="mobile-post-navbtn">Menu</a>
				<ul class="mobile-post-nav">
					<?php 					
						//$journal_pages = array("Home", "Aims & Scope", "Editorial Board","Instructions to Author","Manuscript Work Flow","Currfdfent Issue","Articles in Press","Archive");			
		
						foreach ($journal_pages as $key => $value) {
							echo '<li><a href=".$key.">".$value."</a></li>';
						}
						
					?>
				</ul>
			</div>
			<div>
				<div id="journal-sidebar-wrapper">


					<div id="journal-sidebar">
						<div id="nav-post">
							<ul class="post-nav">

							<?php 																						$url = get_bloginfo('url');								
										foreach ($journal_pages as $key => $value) {
											echo '<li><a href="'.$url.'/'.$segments[2].'/'.$segments[3].'/'.$value.'">'.$key.'</a></li>';
										}
								?>
								
							</ul>
						</div>
					</div>
				</div>
				<div class="journal-info-box">
				</div>
			</div>
		</div>		
		<div class="col-sm-8">		
			<div class="post-text-box">				
				<div id="post-content">
				<?php 
					global $wpdb;
					
					$results = $wpdb->get_results( 'SELECT post_content, post_name FROM wp_journal_posts WHERE post_slug = "'.$segments[4].'" AND journal_slug = "'.$segments[3].'"', ARRAY_A );
					if(count($results) > 0) {
						if($results[0]["post_name"] && $results[0]["post_content"]) {
							echo '<h1>'.$results[0]["post_name"].'</h1>';
							echo '<p>'.$results[0]["post_content"].'</p>';										
						}
					} else {
						if($segments[4] == 'current-issue') {
							echo '<h1>Current Issue</h1>';
						} else if($segments[4] == 'articles-in-press') {
							echo '<h1>Articles In Press</h1>';							
						}else if($segments[4] == 'archive') {
							echo '<h1>Archive</h1>';
						}
					}
				?>
				</div>  	
			</div>
		</div>
	</div>
<!--
</div>
</div>
</div>
</div>


</div><!-- #content -->
</div>
<?php } 
?>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
