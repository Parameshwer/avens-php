<?php function create_category() {?>
<?php 

global $wpdb;
/*if($_POST['insert']) {
    if($_POST['category_id']) {

    }
    $name = $_POST['category_name'];
    $created_date = date("Y-m-d");
    $updated_date = date("Y-m-d");
    $wpdb->insert( 'wp_journal_main_categories', array(
        'category_name' => $name,
        'created_date' => $created_date,
        'updated_date' => $updated_date
        )
    );
    if($wpdb->insert_id) {
        $message.="Main category created successfully";
    }
}*/

if($_POST['insert']) {
    $name = $_POST['category_name'];
    $created_date = date("Y-m-d");
    $updated_date = date("Y-m-d");
    if($_POST['category_id']) {
        $results = $wpdb->update( 
        'wp_journal_main_categories', 
        array( 
            'category_name' => $name,
            'updated_date' => $updated_date
            ), 
        array( 'category_id' => $_GET['id'])  
        );      
         if($results) {
            $message.="Main category updated successfully";
        } else {
            $message.="Main category unable to update";
        }
    } else {
        
        $wpdb->insert( 'wp_journal_main_categories', array(
            'category_name' => $name,
            'created_date' => $created_date,
            'updated_date' => $updated_date
            )
        );
        if($wpdb->insert_id) {
            $message.="Main category created successfully";
        }
    }
    
}

if($_GET['id']) {
    $results = 
    $wpdb->get_results( 'SELECT * FROM  wp_journal_main_categories WHERE category_id = "'.$_GET['id'].'"', ARRAY_A );        
}
?>


<div class="mypluggin-main-content">

    <h1 class="page-header">Main Cateory</h1>
    <div class="form-box">
        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <div class="form-group">
                <label for="category_name" class="col-sm-3 control-label">Category Name</label>
                <div class="col-sm-9">
                    <input type="hidden" name="category_id" value="<?php echo $results['0']['category_id']; ?>">                 
                    <input type="text" class="form-control" id="category_name" name="category_name" required value="<?php echo isset($results['0']['category_name'])?$results['0']['category_name']:''; ?>">
                </div>
            </div>
<!-- <div class="form-group">
<label for="category_image" class="col-sm-3 control-label">Category Image</label>
<div class="col-sm-9">
<input type="file" class="form-control" id="category_image" name="category_image">
</div>
</div> -->
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">                    
        <input type='submit' name="insert" value='Save' class='btn btn-primary'>
    </div>
</div>
</form>
</div>
<?php if (isset($message)){ ?>
<div class="col-sm-offset-3 col-sm-10">
    <div class="updated"><p><?php echo $message;?></p></div>
</div>
<?php } ?>
</div>
<?php } ?>
