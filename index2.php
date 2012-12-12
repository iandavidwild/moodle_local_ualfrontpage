<?php

require_once(dirname(__FILE__) . '/../../config.php');

require_login(0, false);

global $CFG, $DB;

$PAGE->set_url('/local/ualfrontpage/');

$PAGE->requires->js('../../lib/editor/tinymce/tiny_mce/3.5.1.1/tiny_mce.js',true);
//$PAGE->requires->js('../lib/editor/tinymce/3.5.1.1/myeditor.js',true);
$PAGE->requires->css('../../lib/editor/tinymce/tiny_mce/3.5.1.1/themes/advanced/skins/default/ui.css', true);
$PAGE->requires->css('../../lib/editor/tinymce/tiny_mce/3.5.1.1/plugins/inlinepopups/skins/clearlooks2/window.css', true);

//$PAGE->requires->js('/local/ualfrontpage/tinymce/jscripts/tiny_mce/tiny_mce.js',true);
//$PAGE->requires->js('/local/ualfrontpage/tinymce/jscripts/tiny_mce/myeditor.js',true);
//$PAGE->requires->css('/local/ualfrontpage/tinymce/jscripts/tiny_mce/themes/advanced/skins/default/ui.css', true);
//$PAGE->requires->css('/local/ualfrontpage/tinymce/jscripts/tiny_mce/plugins/inlinepopups/skins/clearlooks2/window.css', true);

/*
$PAGE->requires->js('/tinymce/jscripts/tiny_mce/tiny_mce.js',true);
$PAGE->requires->js('/tinymce/jscripts/tiny_mce/myeditor.js',true);

$PAGE->requires->css('/tinymce/jscripts/tiny_mce/themes/advanced/skins/default/ui.css', true);
$PAGE->requires->css('/tinymce/jscripts/tiny_mce/plugins/inlinepopups/skins/clearlooks2/window.css', true);
*/
$context = get_context_instance(CONTEXT_SYSTEM);
$PAGE->set_context($context);
$PAGE->set_title(get_string('pluginname', 'local_ualfrontpage'));

$PAGE->navbar->add(get_string('pluginname', 'local_ualfrontpage'));


$content='';


$content .= $OUTPUT->header();
$content .= $OUTPUT->heading(get_string('pluginname', 'local_ualfrontpage'));

$hassiteconfig = has_capability('moodle/site:config', $context);

if($hassiteconfig) {
    $content .= html_writer::start_tag('div');
        $content .= html_writer::start_tag('form', array('action'=>'index2.php','method'=>'post', 'name'=>'frmfrontpage', 'enctype'=>'multipart/form-data'));
            $content .= html_writer::start_tag('table', array('width'=>'100%'));
                
                $content .= html_writer::start_tag('tr'); //this row for selecting image
                    
                    $content .= html_writer::start_tag('td');
                        $content .= get_string('section1','local_ualfrontpage');
                    $content .= html_writer::end_tag('td');
                    
                    $content .= html_writer::start_tag('td');
                        $content .= html_writer::tag('textarea', '', array('name'=>'section1', 'cols'=>'80', 'rows'=>'15'));
                    $content .= html_writer::end_tag('td');
                    
                $content .= html_writer::end_tag('tr');//finish row for selecting image

                $content .= html_writer::start_tag('tr'); //this row for submit botton
                    
                    $content .= html_writer::start_tag('td');
                        $content .= get_string('section5','local_ualfrontpage');
                    $content .= html_writer::end_tag('td');
                    
                    $content .= html_writer::start_tag('td');
                        $content .= html_writer::tag('textarea', '', array('name'=>'section5', 'cols'=>'80', 'rows'=>'15'));
                    $content .= html_writer::end_tag('td');
                    
                $content .= html_writer::end_tag('tr');
                
                $content .= html_writer::start_tag('tr'); //this row for submit botton
                    
                    $content .= html_writer::start_tag('td');
                        $content .= get_string('section3','local_ualfrontpage');
                    $content .= html_writer::end_tag('td');
                    
                    $content .= html_writer::start_tag('td');
                        $content .= html_writer::tag('textarea', '', array('name'=>'section3', 'cols'=>'80', 'rows'=>'15'));
                    $content .= html_writer::end_tag('td');
                    
                $content .= html_writer::end_tag('tr'); 
                
                $content .= html_writer::start_tag('tr'); //this row for submit botton
                    
                    $content .= html_writer::start_tag('td');
                        $content .= get_string('section4','local_ualfrontpage');
                    $content .= html_writer::end_tag('td');
                    
                    $content .= html_writer::start_tag('td');
                        $content .= html_writer::tag('textarea', '', array('name'=>'section4', 'cols'=>'80', 'rows'=>'15'));
                        //$content .= html_writer::end_tag('textarea');
                    $content .= html_writer::end_tag('td');
                    
                $content .= html_writer::end_tag('tr'); 
                
                $content .= html_writer::start_tag('tr'); //this row for submit botton
                    
                    $content .= html_writer::start_tag('td');
                        //$content .= get_string('section3','local_ualfrontpage');
                    $content .= html_writer::end_tag('td');
                    
                    $content .= html_writer::start_tag('td');
                        $content .= html_writer::empty_tag('input',array('type'=>'submit', 'name'=>'Save', 'id'=>'Save', 'value'=>'Save'));
                    $content .= html_writer::end_tag('td');
                    
                $content .= html_writer::end_tag('tr'); //finish row for submit button
                
            $content .= html_writer::end_tag('table');
        $content .= html_writer::end_tag('form');
    $content .= html_writer::end_tag('div');
}


$content .= $OUTPUT->footer();

echo $content;

if(isset($_POST['Save'])){
    $row = new stdClass();
    $row->section1    = $_POST['section1'];
    $row->section2    = $_POST['section5'];//sectction 5 is replacing section 2 for unknown reason
    $row->section3    = $_POST['section3'];
    $row->section4    = $_POST['section4'];
    $table = 'section'; //destination table name without prefix, where data will save
    $DB->insert_record($table, $row);
}

