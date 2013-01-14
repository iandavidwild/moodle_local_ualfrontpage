<?php

require('../../config.php');
require_once('uploaderform.php');
require_once(dirname(__FILE__) . '/../../lib/filelib.php');

require_login();
if (isguestuser()) {
    die();
}

$returnurl = optional_param('returnurl', '', PARAM_URL);

if (empty($returnurl)) {
    $returnurl = new moodle_url('/local/ualfrontpage/');
}

$context = get_context_instance(CONTEXT_SYSTEM);

$PAGE->set_url('/local/ualfrontpage/');
$PAGE->set_context($context);
$PAGE->set_title(get_string('pluginname', 'local_ualfrontpage'));
$PAGE->set_heading(get_string('pluginname', 'local_ualfrontpage'));
$PAGE->set_pagelayout('mydashboard');
$PAGE->navbar->add(get_string('pluginname', 'local_ualfrontpage'));
//$PAGE->set_pagetype('user-files');

$data = new stdClass();
$data->returnurl = $returnurl;
$options = array('subdirs'=>0, 'maxbytes'=>$CFG->userquota, 'maxfiles'=>10, 'accepted_types'=>array('*.png', '*.jpg', '*.gif','*.jpeg'));
file_prepare_standard_filemanager($data, 'files', $options, $context, 'local_ualfrontpage', 'images', '1');

$mform = new upload_image_form(null, array('data'=>$data, 'options'=>$options));

if ($mform->is_cancelled()) {
    redirect($returnurl);
} else if ($formdata = $mform->get_data()) {
    $DB->delete_records_select('image_rotator',false);
    $formdata = file_postupdate_standard_filemanager($formdata, 'files', $options, $context, 'local_ualfrontpage', 'images', '1');
    //print_r($formdata);
    
    global $DB;
    
    $myfile = new stdClass();
    
    foreach ($formdata as $image) {
        $myfile->image = $image->get_filename();
        $myfile->status = 1;
        $myfile->alt_text = "Welcome to UAL Moodle";
        
        $DB->insert_record('image_rotator', $myfile);
    }
    
    redirect($returnurl);
}

echo $OUTPUT->header();
echo $OUTPUT->box_start('generalbox');
$mform->display();
echo $OUTPUT->box_end();
echo $OUTPUT->footer();
