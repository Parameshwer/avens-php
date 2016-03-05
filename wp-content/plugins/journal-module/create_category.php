<?php function create_category() {?>
<?php 
    if($_POST['insert']) {
        global $wpdb;
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
    }
?>


<div class="mypluggin-main-content">

    <h1 class="page-header">Main Cateory</h1>
    <div class="form-box">
        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <div class="form-group">
                <label for="category_name" class="col-sm-3 control-label">Category Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="category_name" name="category_name" required>
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
