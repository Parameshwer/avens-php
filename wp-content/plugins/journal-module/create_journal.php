<?php 

function create_journal() {
    global $wpdb;

    if($_POST['insert']) {
        $journal_name = $_POST['journal_name'];
        $created_date = date("Y-m-d");
        $updated_date = date("Y-m-d");
        $issn_number = $_POST['issn_number'];
        $banner_image = $_POST['banner_image'];
        $sidebar_image = $_POST['sidebar_image'];
        $journal_meta_keywords = $_POST['journal_meta_keywords'];
        $journal_ic_value = $_POST['journal_ic_value'];
        $main_category = $_POST['main_category'];
        $journal_description    = $_POST['journal_description'];
        if($_POST['id']) {
            $results = $wpdb->update( 
                'wp_journals', 
                array( 
                    'journal_name' => $journal_name,
                    'created_date' => $created_date,
                    'updated_date' => $updated_date,
                    'issn_number'  => $issn_number,
                    'banner_image' =>  $banner_image,
                    'sidebar_image' =>  $sidebar_image,
                    'journal_meta_keywords' => $journal_meta_keywords,
                    'journal_ic_value' => $journal_ic_value,
                    'main_category_id' => $main_category,
                    'journal_description' => $journal_description
                    ), 
                array( 'id' => $_GET['id'])  
                );      
            if($results) {
                $message.="Journal updated successfully";
                
            } else {
                $message.="Journal unable to update";
            }
        } else {

            $wpdb->insert( 'wp_journals', array(
                'journal_name' => $journal_name,
                'created_date' => $created_date,
                'updated_date' => $updated_date,
                'issn_number'  => $issn_number,
                'banner_image' =>  $banner_image,
                'sidebar_image' =>  $sidebar_image,
                'journal_meta_keywords' => $journal_meta_keywords,
                'journal_ic_value' => $journal_ic_value,
                'main_category_id' => $main_category,
                'journal_description' => $journal_description
                )
            );
            //print_r($wpdb->insert_id);
            if($wpdb->insert_id) {
                $message.="Journal created successfully";
            }
        }

    }
    if($_GET['id']) {
        $results = $wpdb->get_results( 'SELECT * FROM  wp_journals WHERE id = "'.$_GET['id'].'"', ARRAY_A );            
    }
    $res = $wpdb->get_results( 'SELECT * FROM  wp_journal_main_categories', ARRAY_A );
    ?>
    <div class="mypluggin-main-content">
        <h1 class="page-header"><?php echo isset($results['0']['id'])?'Edit':'Create'; ?> Journal</h1>
        <div class="form-box">
            <form class="form-horizontal" id="journal_form" enctype="multipart/form-data" method="post">
                <div class="form-group">
                    <label for="journal_name" class="col-sm-3 control-label">Journal Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="journal_name" name="journal_name" required value="<?php echo isset($results['0']['journal_name'])?$results['0']['journal_name']:''; ?>">
                        <input type="hidden" name="id" value="<?php echo $results['0']['id']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="issn_number" class="col-sm-3 control-label">Issn Number</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="issn_number" name="issn_number" value="<?php echo isset($results['0']['issn_number'])?$results['0']['issn_number']:''; ?>" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="banner_image" class="col-sm-3 control-label">Banner Image</label>
<!-- <div class="col-sm-9">
<input type="file" class="form-control" id="file" name="file" required>
</div> -->
<div class="col-sm-9">
    <input type="text" name="banner_image" id="banner_image" class="regular-text" value="<?php echo isset($results['0']['banner_image'])?$results['0']['banner_image']:''; ?>">
    <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">
    <?php 
    wp_enqueue_script('jquery');
    wp_enqueue_media();
    ?>                        
</div>
</div>
<div class="form-group">
    <label for="sidebar_image" class="col-sm-3 control-label">Sidebar Image</label>
    <div class="col-sm-9">
        <input type="text" name="sidebar_image" id="sidebar_image" class="regular-text" value="<?php echo isset($results['0']['sidebar_image'])?$results['0']['sidebar_image']:''; ?>">
        <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">
        <?php 
        wp_enqueue_script('jquery');
        wp_enqueue_media();
        ?>                        
    </div>
</div>
<div class="form-group">
    <label for="journal_meta_keywords" class="col-sm-3 control-label">Journal Meta Keywords</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="journal_meta_keywords" name="journal_meta_keywords" value="<?php echo isset($results['0']['journal_meta_keywords'])?$results['0']['journal_meta_keywords']:''; ?>" >
    </div>
</div>
<div class="form-group">
    <label for="journal_ic_value" class="col-sm-3 control-label">Journal Ic Value</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="journal_ic_value" name="journal_ic_value" value="<?php echo isset($results['0']['journal_ic_value'])?$results['0']['journal_ic_value']:''; ?>" >
    </div>
</div>
<div class="form-group">
    <label for="main_category" class="col-sm-3 control-label">Main Category</label>
    <div class="col-sm-9">
        
        <select class="form-control" name="main_category">
            <?php 
            
            foreach ($res as $key => $value) {
                if($results['0']['main_category_id'] == $value['category_id']) {
                    echo '<option selected value='.$value['category_id'].'>'.$value['category_name'].'</option>';
                } else {
                    echo '<option value='.$value['category_id'].'>'.$value['category_name'].'</option>';
                }                                       
            }
            ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="journal_description" class="col-sm-3 control-label">Journal Description</label>
    <div class="col-sm-9">
        <input type="text" class="form-control" id="journal_description" name="journal_description" value="<?php echo isset($results['0']['journal_description'])?$results['0']['journal_description']:''; ?>">
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
        <input type='submit' name="insert" value='Save' class='btn btn-primary'>
    </div>
</div>
</form>
</div>
</div>    
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('.button-secondary').click(function(e) {
            var ME = $(e.target);
            e.preventDefault();
            var image = wp.media({ 
                title: 'Upload Image',
                multiple: false
            }).open()
            .on('select', function(e){
                var uploaded_image = image.state().get('selection').first();
//console.log(uploaded_image);
var image_url = uploaded_image.toJSON().url;
console.log(ME);
console.log($(this));
ME.closest('.form-group').find('.regular-text').val(image_url);
});
        });
    });
</script>
<?php if (isset($message)){ ?>
<div class="col-sm-12">
    <div class="updated"><p><?php echo $message;?></p></div>
</div>
<?php } ?>
<?php } ?>