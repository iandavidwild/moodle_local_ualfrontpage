<?php

require_once(dirname(__FILE__) . '/../../config.php');

require_login(0, false);

global $CFG, $DB;

$PAGE->set_url('/local/ualfrontpage/');
$context = get_context_instance(CONTEXT_SYSTEM);
$PAGE->set_context($context);
$PAGE->set_title(get_string('pluginname', 'local_ualfrontpage'));

$PAGE->navbar->add(get_string('pluginname', 'local_ualfrontpage'));

$content='';

$content .= $OUTPUT->header();
$content .= $OUTPUT->heading(get_string('pluginname', 'local_ualfrontpage'));

$hassiteconfig = has_capability('moodle/site:config', $context);

if($hassiteconfig) {
    /*$content .= html_writer::start_tag('div');
    
    // example lang string
    // $string['delete'] = 'Delete';
    get_string('delete', 'local_ualfrontopage');
    
    ...*/
    
    $content .= html_writer::start_tag('form', array('action'=>'index.php','method'=>'post', 'name'=>'frmfrontpage'));
    
    // News and announcements
    $content .= html_writer::start_tag('fieldset');
    $content .= html_writer::start_tag('legend');
    $content .= get_string('newsandannouncements','local_ualfrontpage');
    $content .= html_writer::end_tag('legend');
    $content .= html_writer::start_tag('label', array('for'=>'maxitems'));
    $content .= get_string('maxnewsitems','local_ualfrontpage');
    $content .= html_writer::end_tag('label') . ' ';
    $content .= html_writer::start_tag('input', array('id'=>'maxitems','name'=>'maxitems','type'=>'text'));
    $content .= html_writer::end_tag('legend');
    $content .= html_writer::end_tag('fieldset');
    
    $content .= html_writer::end_tag('form');
    
    
    
    //
    // Image rotator
    //
    
    //$dir = $CFG->wwwroot .'/local/ualfrontpage/pix/';
    $dir = $CFG->dataroot .'/filedir/';
    $image_dir = $CFG->dataroot .'/filedir/';
    $existing_files = '';
    $number_of_images = $DB->count_records('image_rotator', array('status'=>'1'));
    
    $display_order=0;
    if ($number_of_images < 1){
        $existing_files .= get_string('noimage','theme_ual');
    }else{
        //$row_counter = 1;
        //echo 'There is some images to show....';
        $existing_files .= html_writer::start_tag('div');
        $existing_files .= html_writer::start_tag('table' , array('border'=>'1', 'width'=>'800'));
        $records = $DB->get_records_sql('select * from mdl_image_rotator where status = ?', array('1'));// oder by display_order');
        foreach ($records as $record){
            
            $display_order=$record->display_order;
            
            $existing_files .= html_writer::start_tag('form', array('action'=>'index.php','method'=>'post', 'name'=>'edit_image' . $record->id , 'enctype'=>'multipart/form-data'));
            $existing_files .= html_writer::empty_tag('input', array('type'=>'hidden', 'name'=>'image_id', 'value'=>$record->id));
            $existing_files .= html_writer::start_tag('tr');
                $existing_files .= html_writer::start_tag('td');
                    $existing_files .= get_string('imageorder','theme_ual');
                $existing_files .= html_writer::end_tag('td');
                
                $existing_files .= html_writer::start_tag('td');
                    //display record from database
                    $existing_files .= html_writer::empty_tag('input', array('type'=>'text', 'name'=>'display_order', 'value'=>$record->display_order));
                $existing_files .= html_writer::end_tag('td');
                
                $existing_files .= html_writer::start_tag('td', array('rowspan'=>'4', 'bgcolor'=>'green', 'width'=>'160'));
                    $image_url = $image_dir . $record->image_name;
                    $existing_files .= '<img src="'.$image_url.'">';
                $existing_files .= html_writer::end_tag('td');
                
                $existing_files .= html_writer::start_tag('td');
                    //change image
                    $existing_files .= html_writer::empty_tag('input', array('type'=>'file', 'name'=>'file'));
                $existing_files .= html_writer::end_tag('td');
                                
            $existing_files .= html_writer::end_tag('tr');
            
            $existing_files .= html_writer::start_tag('tr');
                $existing_files .= html_writer::start_tag('td');
                    $existing_files .= get_string('filename','theme_ual');
                $existing_files .= html_writer::end_tag('td');
                
                $existing_files .= html_writer::start_tag('td');
                    //display record from database
                    $existing_files .= $record->image_name;
                $existing_files .= html_writer::end_tag('td');
                
                $existing_files .= html_writer::start_tag('td');
                    //display record from database
                    $existing_files .= html_writer::empty_tag('input',array('type'=>'submit', 'name'=>'Update', 'id'=>'Update', 'value'=>'Update'));
                $existing_files .= html_writer::end_tag('td');
                
            $existing_files .= html_writer::end_tag('tr');
            
            $existing_files .= html_writer::start_tag('tr');
                $existing_files .= html_writer::start_tag('td');
                    $existing_files .= get_string('filewidth','theme_ual');
                $existing_files .= html_writer::end_tag('td');
                
                $existing_files .= html_writer::start_tag('td');
                    //display record from database
                    $existing_files .= $record->width;
                $existing_files .= html_writer::end_tag('td');
            $existing_files .= html_writer::end_tag('tr');
            
            $existing_files .= html_writer::start_tag('tr');
                $existing_files .= html_writer::start_tag('td');
                    $existing_files .= get_string('fileheight','theme_ual');
                $existing_files .= html_writer::end_tag('td');
                
                $existing_files .= html_writer::start_tag('td');
                    //display record from database
                    $existing_files .= $record->height;
                $existing_files .= html_writer::end_tag('td');
            $existing_files .= html_writer::end_tag('tr');
            
            $existing_files .= html_writer::start_tag('tr');
                $existing_files .= html_writer::start_tag('td');
                    $existing_files .= get_string('alttext','theme_ual');
                $existing_files .= html_writer::end_tag('td');
                
                $existing_files .= html_writer::start_tag('td');
                    //display record from database
                    $existing_files .= html_writer::empty_tag('input', array('type'=>'text', 'name'=>'alt_text', 'value'=>$record->alt_text));
                $existing_files .= html_writer::end_tag('td');
                
            $existing_files .= html_writer::end_tag('tr');
            $existing_files .= html_writer::end_tag('form');
        }
        $existing_files .= html_writer::end_tag('table');
        $existing_files .= html_writer::end_tag('div');
    }
    
    
   $content .= $existing_files;
    
    $content .= html_writer::start_tag('div');
        $content .= html_writer::start_tag('form', array('action'=>'index.php','method'=>'post', 'name'=>'frmfrontpage', 'enctype'=>'multipart/form-data'));
            $content .= html_writer::start_tag('table', array('border'=>'1' , 'width'=>'600'));
                
                $content .= html_writer::start_tag('tr'); //this row for selecting image
                    $content .= html_writer::start_tag('td');
                        $content .= get_string('uploadfilestext','theme_ual');
                    $content .= html_writer::end_tag('td');
                    $content .= html_writer::start_tag('td');
                        $content .= html_writer::empty_tag('input', array('type'=>'file', 'name'=>'file'));
                    $content .= html_writer::end_tag('td');
                $content .= html_writer::end_tag('tr');//finish row for selecting image
                //list($width, $height, $type, $attr) = getimagesize($dir . $_FILES["file"]["name"]);
                $content .= html_writer::start_tag('tr');//this row for alt text for image
                    $content .= html_writer::start_tag('td');
                        $content .= get_string('alttext','theme_ual');    
                    $content .= html_writer::end_tag('td');
                    $content .= html_writer::start_tag('td');
                        $content .= html_writer::empty_tag('input', array('type'=>'text', 'name'=>'alt_text'));
                    $content .= html_writer::end_tag('td');
                $content .= html_writer::end_tag('tr'); //finish row for alt text for image
                
                $content .= html_writer::start_tag('tr'); //this row for image width
                    $content .= html_writer::start_tag('td');
                        $content .= get_string('filewidth','theme_ual');    
                    $content .= html_writer::end_tag('td');
                    $content .= html_writer::start_tag('td');
                        $content .= html_writer::empty_tag('input', array('type'=>'text', 'name'=>'image_width', 'value'=>'540', 'readonly'));
                        $content .= get_string('px','theme_ual');
                    $content .= html_writer::end_tag('td');
                $content .= html_writer::end_tag('tr'); //finish row for image width
                
                $content .= html_writer::start_tag('tr'); //this row for image height
                    $content .= html_writer::start_tag('td');
                        $content .= get_string('fileheight','theme_ual');    
                    $content .= html_writer::end_tag('td');
                    $content .= html_writer::start_tag('td');
                        $content .= html_writer::empty_tag('input', array('type'=>'text', 'name'=>'image_height', 'value'=>'290', 'readonly'));
                        $content .= get_string('px','theme_ual');
                    $content .= html_writer::end_tag('td');
                $content .= html_writer::end_tag('tr'); //finish row for image height
                
                $content .= html_writer::start_tag('tr'); //this row for submit botton
                    $content .= html_writer::start_tag('td');
                        //$content .= html_writer::empty_tag('input',array('type'=>'submit', 'name'=>'submit', 'id'=>'submit', 'value'=>'Save'));
                    $content .= html_writer::end_tag('td');
                    $content .= html_writer::start_tag('td');
                        $content .= html_writer::empty_tag('input',array('type'=>'submit', 'name'=>'Save', 'id'=>'Save', 'value'=>'Save'));
                    $content .= html_writer::end_tag('td');
                $content .= html_writer::end_tag('tr'); //finish row for submit button
                
            $content .= html_writer::end_tag('table');
        $content .= html_writer::end_tag('form');
    $content .= html_writer::end_tag('div');
}

//$content .= sort($files);

//$content .= print_r($files);

//$content .= $number_of_images;


if(isset($_POST['Save'])){
    
    echo $_FILES["file"]["name"];
    $allowedExts = array("JPG", "JPEG", "GIF", "PNG", "jpg", "jpeg", "gif", "png");
    $extension = end(explode(".", $_FILES["file"]["name"]));
    $alt_text= $_POST['alt_text'];
    if ((($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpg")
    || ($_FILES["file"]["type"] == "image/png")
    || ($_FILES["file"]["type"] == "image/jpeg"))
    && in_array($extension, $allowedExts)) {
        
        if ($_FILES["file"]["error"] > 0){
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
        }
        else{
            if (file_exists($dir . $_FILES["file"]["name"])){
                echo $_FILES["file"]["name"] . " already exists. ";
            }
            else {
                
                echo $dir . $_FILES["file"]["name"];
                
                move_uploaded_file($_FILES["file"]["tmp_name"],
                $dir . $_FILES["file"]["name"]);
                echo $OUTPUT->box('Image successfully uploaded!');
                //echo "Stored in: " . "/local/ualfrontpage/pix/" . $_FILES["file"]["name"];
                
                //to save files in to database............
                //$sql = "Select id, image, width, height, alt_text, status, display_order from mdl_image_folder where status=1";
                list($width, $height, $type, $attr) = getimagesize($dir . $_FILES["file"]["name"]);
                $row = new stdClass();
                //$row->id    = $id;
                $row->image = $_FILES["file"]["name"];
                $row->width    = $width;
                $row->height    = $height;
                $row->alt_text    = $alt_text;
                $row->status    = 1;
                $row->display_order    = $display_order+1;
                if ($width==540 && $height==290){
                    $table = 'image_rotator';
                    $DB->insert_record($table, $row);
                }else{
                    echo 'Selected image size is not correct! Please upload different image (widht=540 and height=290)';
                }
                
            }
        }
    }
    else{
        echo "Invalid file";
    }
    
    
   // move_uploaded_file($_FILES["file"]["tmp_name"],
   //             "/local/ualfrontpage/pix/" . $_FILES["file"]["name"]);
    
    
}

if(isset($_POST['Update'])){
    echo $_FILES["file"]["name"];
    $allowedExts = array("JPG", "JPEG", "GIF", "PNG", "jpg", "jpeg", "gif", "png");
    $extension = end(explode(".", $_FILES["file"]["name"]));
    $alt_text= $_POST['alt_text'];
    if ((($_FILES["file"]["type"] == "image/gif")
    || ($_FILES["file"]["type"] == "image/jpg")
    || ($_FILES["file"]["type"] == "image/png")
    || ($_FILES["file"]["type"] == "image/jpeg"))
    && in_array($extension, $allowedExts)) {
        
        if ($_FILES["file"]["error"] > 0){
            echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
        }
        else{
            if (file_exists($dir . $_FILES["file"]["name"])){
                echo $_FILES["file"]["name"] . " already exists. ";
            }
            else{
                move_uploaded_file($_FILES["file"]["tmp_name"],
                $dir . $_FILES["file"]["name"]);
                echo $OUTPUT->box('Image successfully uploaded!');
                //echo "Stored in: " . "/local/ualfrontpage/pix/" . $_FILES["file"]["name"];
                
                //to save files in to database............
                //$sql = "Select id, image, width, height, alt_text, status, display_order from mdl_image_folder where status=1";
                list($width, $height, $type, $attr) = getimagesize($dir . $_FILES["file"]["name"]);
                $row = new stdClass();
                //$row->id    = $id;
                $row->image_name = $_FILES["file"]["name"];
                $row->width    = $width;
                $row->height    = $height;
                $row->alt_text    = $alt_text;
                $row->status    = 1;
                $row->display_order    = $record->display_order+1;
                if ($width==540 && $height==290){
                    $table = 'image_folder';
                    $DB->insert_record($table, $row);
                }else{
                    echo 'Selected image size is not correct! Please upload different image (widht=540 and height=290)';
                }
                
            }
        }
    }
    else{
        echo "Invalid file";
    }
}


$content .= $OUTPUT->footer();

echo $content;

