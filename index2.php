<?php

require_once(dirname(__FILE__) . '/../../config.php');

require_login(0, false);

global $CFG, $DB;

$PAGE->set_url('/local/ualfrontpage/');

$jslink1 = new moodle_url('../lib/editor/tinymce/tiny_mce/3.5.1.1/tiny_mce.js');
$jslink2 = new moodle_url('/script/myeditor.js');
$csslink1 = new moodle_url('../lib/editor/tinymce/tiny_mce/3.5.1.1/themes/advanced/skins/default/ui.css');
$csslink2 = new moodle_url('../../lib/editor/tinymce/tiny_mce/3.5.1.1/plugins/inlinepopups/skins/clearlooks2/window.css');

$PAGE->requires->js($jslink1,true);
$PAGE->requires->css($jslink2, true);
$PAGE->requires->css($csslink1, true);
$PAGE->requires->css($csslink2, true);

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


/*tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
    plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

    //// Theme options
    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,

    //// Example content CSS (should be your site CSS)
    //content_css : "css/content.css",

    //// Drop lists for link/image/media/template dialogs
    template_external_list_url : "lists/template_list.js",
    external_link_list_url : "lists/link_list.js",
    external_image_list_url : "lists/image_list.js",
    media_external_list_url : "lists/media_list.js",
    
    });
*/

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


$content .= '<script>tinyMCE.init({ mode : "textareas", });</script>';

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

