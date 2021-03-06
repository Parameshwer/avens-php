<?php 
/*
Plugin Name: journal module
Plugin URI: ""
Descriptionription: journal module
Version: 
Author: Parameshwer Chiluveri
Author URI: 
License:    
*/

// Hook for adding admin menus
add_action('admin_menu', 'adding_admin_menu');
// action function for above hook
function adding_admin_menu() {
    add_menu_page ( 
        'Journal Creating Page', 
        'Create main Category',
        'manage_options',
        'create_category',
        'create_category',
        'dashicons-admin-generic'
        ); 
    add_submenu_page(
        'create_category',
        'Create Journal',
        'Create Journal',
        'manage_options',
        'create_journal',
        'create_journal'
        ); 
    add_submenu_page('create_category',
        'Create Journal Post',
        'Create Journal Post',
        'manage_options',
        'create_journal_post',
        'create_journal_post'
        ); 
     add_submenu_page('create_category',
        'Create Archive',
        'Create Archive',
        'manage_options',
        'create_archive',
        'create_archive'
        );
    add_submenu_page('create_category',
        'All Journal Posts',
        'All Journal Posts',
        'manage_options',
        'all_journal_posts',
        'all_journal_posts'
        );
    add_submenu_page('create_category',
        'All Journals',
        'All Journals',
        'manage_options',
        'all_journals',
        'all_journals'
        );
    add_submenu_page('create_category',
        'All Categories',
        'All Categories',
        'manage_options',
        'all_categories',
        'all_categories'
        ); 

   
    add_submenu_page('create_category',
        'All Archives',
        'All Archives',
        'manage_options',
        'all_archives',
        'all_archives'
        ); 
    //add_submenu_page('Create Journal Post', 'Create Journal Post', 'create_journal_post', 'manage_options', 'create_journal_post', 'create_journal_post' ); 
}



define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'create_category.php');
require_once(ROOTDIR . 'create_journal.php');
require_once(ROOTDIR . 'create_journal_post.php');
require_once(ROOTDIR . 'all_categories.php');
require_once(ROOTDIR . 'all_journals.php');
require_once(ROOTDIR . 'all_journal_posts.php');
require_once(ROOTDIR . 'create_archive.php');
require_once(ROOTDIR . 'all_archives.php');

/*add_action('wp_print_scripts', 'journal_module_script');
function journal_module_script() {
    if(!file_exists($link)){
        if(!is_admin())
    wp_enqueue_script('validate','https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.js', array('jquery'), '', true);

    }
}*/

//echo '<link href="'. plugins_url( 'css/bootstrap.min.css' , __FILE__ ) . '" rel="stylesheet" type="text/css" />';
if(is_admin()){
function add_header_phpmodule() {
    wp_enqueue_style( 'bootstrap-css', plugin_dir_url( __FILE__ ).'css/bootstrap.min.css');
    wp_enqueue_style( 'my-css', plugin_dir_url( __FILE__ ).'css/my-style.css');
    wp_enqueue_script('validator', plugin_dir_url( __FILE__ ).'js/jquery.validator.js');
    wp_enqueue_script('bootstrap', plugin_dir_url( __FILE__ ).'js/bootstrap.min.js');
    wp_enqueue_script('my-js', plugin_dir_url( __FILE__ ).'js/my-script.js');

}
add_action('init', 'add_header_phpmodule');
}

?>
